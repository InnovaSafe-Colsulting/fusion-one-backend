<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BulkImportProductsImport implements ToCollection, WithHeadingRow
{
    public int    $registersOk = 0;
    public int    $errorsCount = 0;
    private string $batch;

    public function __construct(private int $tenantId)
    {
        $this->batch = uniqid('batch_', true);
    }

    public function getBatch(): string
    {
        return $this->batch;
    }

    public function collection(Collection $rows): void
    {
        $tmpRows = $rows->map(fn($row) => [
            'import_batch'   => $this->batch,
            'tenant_id'      => (string) $this->tenantId,
            'name'           => trim($row['nombre'] ?? ''),
            'sku'            => trim($row['sku'] ?? ''),
            'barcode'        => trim($row['barcode'] ?? ''),
            'description'    => trim($row['descripcion'] ?? ''),
            'cost'           => trim($row['costo'] ?? ''),
            'price'          => trim($row['precio'] ?? ''),
            'is_active'      => trim($row['estado'] ?? '1'),
            'category_id'    => trim($row['category_id'] ?? ''),
            'type_product_id'=> trim($row['type_product_id'] ?? ''),
            'error'          => null,
            'created_at'     => now(),
            'updated_at'     => now(),
        ])->toArray();

        DB::table('tmp_products')->insert($tmpRows);

        $this->validate();
    }

    private function validate(): void
    {
        $rows = DB::table('tmp_products')
            ->where('import_batch', $this->batch)
            ->get();

        $validCategoryIds = DB::table('categories')
            ->where('tenant_id', $this->tenantId)
            ->where('is_active', 1)
            ->pluck('id')
            ->map(fn($id) => (string) $id)
            ->toArray();

        $validTypeIds = DB::table('product_types')
            ->where('tenant_id', $this->tenantId)
            ->where('is_active', 1)
            ->pluck('id')
            ->map(fn($id) => (string) $id)
            ->toArray();

        foreach ($rows as $row) {
            $errors = [];

            if (empty($row->name)) {
                $errors[] = "nombre es obligatorio";
            }

            if ($row->price === '' || !is_numeric($row->price)) {
                $errors[] = "precio debe ser numérico";
            }

            if ($row->cost === '' || !is_numeric($row->cost)) {
                $errors[] = "costo debe ser numérico";
            }

            if (!empty($row->category_id) && !in_array($row->category_id, $validCategoryIds)) {
                $errors[] = "category_id '{$row->category_id}' no existe";
            }

            if (!empty($row->type_product_id) && !in_array($row->type_product_id, $validTypeIds)) {
                $errors[] = "type_product_id '{$row->type_product_id}' no existe";
            }

            if (!empty($errors)) {
                DB::table('tmp_products')
                    ->where('id', $row->id)
                    ->update(['error' => implode(', ', $errors)]);
                $this->errorsCount++;
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
                $this->registersOk++;
            }
        }

        // Limpiar registros OK de tmp
        DB::table('tmp_products')
            ->where('import_batch', $this->batch)
            ->whereNull('error')
            ->delete();
    }
}
