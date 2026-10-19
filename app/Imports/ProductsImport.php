<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithLimit;

class ProductsImport implements ToCollection, WithHeadingRow
{
    public array $errors  = [];
    public int   $created = 0;

    public function __construct(private int $tenantId) {}

    public function collection(Collection $rows): void
    {
        foreach ($rows as $index => $row) {
            $rowNumber = $index + 2;

            $name  = trim($row['nombre'] ?? '');
            $price = $row['precio'] ?? null;
            $cost  = $row['costo'] ?? null;

            if (empty($name)) {
                $this->errors[] = "Fila {$rowNumber}: el campo 'nombre' es obligatorio.";
                continue;
            }

            if ($price === null || !is_numeric($price)) {
                $this->errors[] = "Fila {$rowNumber}: el campo 'precio' debe ser numérico.";
                continue;
            }

            if ($cost === null || !is_numeric($cost)) {
                $this->errors[] = "Fila {$rowNumber}: el campo 'costo' debe ser numérico.";
                continue;
            }

            $estado = isset($row['estado']) ? (int) $row['estado'] : 1;

            DB::table('products')->insert([
                'tenant_id'       => $this->tenantId,
                'name'            => $name,
                'sku'             => trim($row['sku'] ?? ''),
                'barcode'         => trim($row['barcode'] ?? '') ?: null,
                'description'     => trim($row['descripcion'] ?? '') ?: null,
                'cost'            => (float) $cost,
                'price'           => (float) $price,
                'is_active'       => $estado === 1,
                'category_id'     => !empty($row['category_id']) ? (int) $row['category_id'] : null,
                'type_product_id' => !empty($row['type_product_id']) ? (int) $row['type_product_id'] : null,
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);

            $this->created++;
        }
    }
}
