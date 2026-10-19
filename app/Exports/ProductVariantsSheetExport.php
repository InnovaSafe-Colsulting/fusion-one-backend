<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductVariantsSheetExport implements FromArray, WithHeadings, WithTitle
{
    public function title(): string { return 'Variantes'; }

    public function headings(): array
    {
        return ['product_id', 'nombre', 'sku', 'barcode', 'precio', 'costo', 'estado'];
    }

    public function array(): array
    {
        return [
            [1, 'Variante Ejemplo', 'VAR-001', '7702011234567', '10.00', '5.00', '1'],
        ];
    }
}
