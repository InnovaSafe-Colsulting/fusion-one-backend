<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductsTemplateExport implements Export, WithMultipleSheets
{
    use Exportable;
    public function __construct(private int $tenantId) {}

    public function sheets(): array
    {
        return [
            'Productos'      => new ProductsSheetExport(),
            'Categorias'     => new CategoriesSheetExport($this->tenantId),
            'TiposProducto'  => new ProductTypesSheetExport($this->tenantId),
        ];
    }
}
