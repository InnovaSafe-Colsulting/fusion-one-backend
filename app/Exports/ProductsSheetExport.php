<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsSheetExport implements FromArray, WithTitle, WithHeadings
{
    public function title(): string
    {
        return 'Productos';
    }

    public function headings(): array
    {
        return ['nombre', 'sku', 'barcode', 'descripcion', 'costo', 'precio', 'estado', 'category_id', 'type_product_id'];
    }

    public function array(): array
    {
        return [
            ['Ejemplo Producto', 'SKU-001', '7702011234567', 'Descripción del producto', '5.00', '10.00', '1', 1, 1],
        ];
    }
}
