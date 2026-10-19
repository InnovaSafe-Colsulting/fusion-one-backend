<?php

namespace App\Jobs;

use App\Imports\RawImport;
use App\Exports\BulkImportVariantsErrorsExport;
use App\Mail\BulkImportVariantResultMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class BulkImportVariantsJob implements ShouldQueue
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
        try {
            $batch    = uniqid('vbatch_', true);
            $fullPath = Storage::path($this->filePath);

            $rows    = Excel::toArray(new RawImport(), $fullPath)[0] ?? [];
            $headers  = array_map('strtolower', array_map('trim', $rows[0] ?? []));
            $dataRows = array_slice($rows, 1);

            $tmpRows = [];
            foreach ($dataRows as $row) {
                $mapped   = array_combine($headers, array_pad($row, count($headers), null));
                $tmpRows[] = [
                    'import_batch' => $batch,
                    'product_id'   => trim((string) ($mapped['product_id'] ?? '')),
                    'name'         => trim((string) ($mapped['nombre'] ?? '')),
                    'sku'          => trim((string) ($mapped['sku'] ?? '')),
                    'barcode'      => trim((string) ($mapped['barcode'] ?? '')),
                    'price'        => trim((string) ($mapped['precio'] ?? '')),
                    'cost'         => trim((string) ($mapped['costo'] ?? '')),
                    'is_active'    => trim((string) ($mapped['estado'] ?? '1')),
                    'error'        => null,
                    'created_at'   => now(),
                    'updated_at'   => now(),
                ];
            }

            if (empty($tmpRows)) {
                Mail::to($this->userEmail)->send(new BulkImportVariantResultMail($this->userName, 0, 0, null));
                Storage::delete($this->filePath);
                return;
            }

            DB::table('tmp_product_variants')->insert($tmpRows);

            $validProductIds = DB::table('products')
                ->where('tenant_id', $this->tenantId)
                ->where('is_active', 1)
                ->pluck('id')
                ->map(fn($id) => (string) $id)
                ->toArray();

            $rows        = DB::table('tmp_product_variants')->where('import_batch', $batch)->get();
            $registersOk = 0;
            $errorsCount = 0;

            foreach ($rows as $row) {
                $errors = [];

                if (empty($row->product_id) || !in_array($row->product_id, $validProductIds)) {
                    $errors[] = "product_id '{$row->product_id}' no existe o no está activo";
                }
                if (empty($row->name)) {
                    $errors[] = "nombre es obligatorio";
                }
                if (strlen($row->price) === 0 || !is_numeric($row->price)) {
                    $errors[] = "precio debe ser numérico (valor: '{$row->price}')";
                }
                if (strlen($row->cost) === 0 || !is_numeric($row->cost)) {
                    $errors[] = "costo debe ser numérico (valor: '{$row->cost}')";
                }

                if (!empty($errors)) {
                    DB::table('tmp_product_variants')->where('id', $row->id)
                        ->update(['error' => implode(', ', $errors)]);
                    $errorsCount++;
                } else {
                    DB::table('product_variants')->insert([
                        'product_id' => (int) $row->product_id,
                        'name'       => $row->name,
                        'sku'        => $row->sku ?: null,
                        'barcode'    => $row->barcode ?: null,
                        'price'      => (float) $row->price,
                        'cost'       => (float) $row->cost,
                        'is_active'  => $row->is_active === '1' || $row->is_active === 'true',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $registersOk++;
                }
            }

            DB::table('tmp_product_variants')->where('import_batch', $batch)->whereNull('error')->delete();

            $errorFilePath = null;
            if ($errorsCount > 0) {
                $errorFilePath = 'tmp/variant_errors_' . $batch . '.xlsx';
                Excel::store(new BulkImportVariantsErrorsExport($batch), $errorFilePath);
                DB::table('tmp_product_variants')->where('import_batch', $batch)->delete();
            }

            Mail::to($this->userEmail)->send(
                new BulkImportVariantResultMail($this->userName, $registersOk, $errorsCount, $errorFilePath)
            );

            Storage::delete($this->filePath);
            if ($errorFilePath) Storage::delete($errorFilePath);
        } catch (\Throwable $e) {
            Log::error('BulkImportVariantsJob failed: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        }
    }
}
