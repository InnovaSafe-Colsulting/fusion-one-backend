<?php

namespace App\Jobs;

use App\Imports\RawImport;
use App\Exports\BulkImportErrorsExport;
use App\Mail\BulkImportResultMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BulkImportProductsJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private string $filePath,
        private int    $tenantId,
        private string $userEmail,
        private string $userName,
    ) {}

    public function handle(): void
    {
        $batch    = uniqid('batch_', true);
        $fullPath = Storage::path($this->filePath);

        // Leer Excel e insertar en tmp_products
        $rows = Excel::toArray(new RawImport(), $fullPath)[0] ?? [];
        $headers = array_map('strtolower', array_map('trim', $rows[0] ?? []));
        $dataRows = array_slice($rows, 1);

        $tmpRows = [];
        foreach ($dataRows as $row) {
            $mapped = array_combine($headers, array_pad($row, count($headers), null));
            $tmpRows[] = [
                'import_batch'    => $batch,
                'tenant_id'       => (string) $this->tenantId,
                'name'            => trim((string) ($mapped['nombre'] ?? '')),
                'sku'             => trim((string) ($mapped['sku'] ?? '')),
                'barcode'         => trim((string) ($mapped['barcode'] ?? '')),
                'description'     => trim((string) ($mapped['descripcion'] ?? '')),
                'cost'            => trim((string) ($mapped['costo'] ?? '')),
                'price'           => trim((string) ($mapped['precio'] ?? '')),
                'is_active'       => trim((string) ($mapped['estado'] ?? '1')),
                'category_id'     => trim((string) ($mapped['category_id'] ?? '')),
                'type_product_id' => trim((string) ($mapped['type_product_id'] ?? '')),
                'error'           => null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ];
        }

        if (empty($tmpRows)) {
            Mail::to($this->userEmail)->send(new BulkImportResultMail($this->userName, 0, 0, null));
            Storage::delete($this->filePath);
            return;
        }

        DB::table('tmp_products')->insert($tmpRows);

        // Validar
        $validCategoryIds = DB::table('categories')
            ->where('tenant_id', $this->tenantId)->where('is_active', 1)
            ->pluck('id')->map(fn($id) => (string) $id)->toArray();

        $validTypeIds = DB::table('product_types')
            ->where('tenant_id', $this->tenantId)->where('is_active', 1)
            ->pluck('id')->map(fn($id) => (string) $id)->toArray();

        $rows = DB::table('tmp_products')->where('import_batch', $batch)->get();

        $registersOk = 0;
        $errorsCount = 0;

        foreach ($rows as $row) {
            $errors = [];

            if (empty($row->name)) {
                $errors[] = "nombre es obligatorio";
            }
            if (strlen($row->price) === 0 || !is_numeric($row->price)) {
                $errors[] = "precio debe ser numérico (valor: '{$row->price}')";
            }
            if (strlen($row->cost) === 0 || !is_numeric($row->cost)) {
                $errors[] = "costo debe ser numérico (valor: '{$row->cost}')";
            }
            if (!empty($row->category_id) && !in_array($row->category_id, $validCategoryIds)) {
                $errors[] = "category_id '{$row->category_id}' no existe";
            }
            if (!empty($row->type_product_id) && !in_array($row->type_product_id, $validTypeIds)) {
                $errors[] = "type_product_id '{$row->type_product_id}' no existe";
            }

            if (!empty($errors)) {
                DB::table('tmp_products')->where('id', $row->id)
                    ->update(['error' => implode(', ', $errors)]);
                $errorsCount++;
            } else {
                DB::table('products')->insert([
                    'tenant_id'       => $this->tenantId,
                    'name'            => $row->name,
                    'sku'             => $row->sku ?: null,
                    'barcode'         => $row->barcode ?: null,
                    'description'     => $row->description ?: null,
                    'cost'            => (float) $row->cost,
                    'price'           => (float) $row->price,
                    'is_active'       => $row->is_active === '1' || $row->is_active === 'true',
                    'category_id'     => $row->category_id ?: null,
                    'type_product_id' => $row->type_product_id ?: null,
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);
                $registersOk++;
            }
        }

        // Limpiar OK de tmp
        DB::table('tmp_products')->where('import_batch', $batch)->whereNull('error')->delete();

        // Generar Excel de errores si hay
        $errorFilePath = null;
        if ($errorsCount > 0) {
            $errorFilePath = 'tmp/bulk_errors_' . $batch . '.xlsx';
            Excel::store(new BulkImportErrorsExport($batch), $errorFilePath);

            // Limpiar tmp_products con errores
            DB::table('tmp_products')->where('import_batch', $batch)->delete();
        }

        Mail::to($this->userEmail)->send(
            new BulkImportResultMail($this->userName, $registersOk, $errorsCount, $errorFilePath)
        );

        Storage::delete($this->filePath);

        if ($errorFilePath) {
            Storage::delete($errorFilePath);
        }
    }
}
