<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductVariantsTemplateExport implements Export, WithMultipleSheets
{
    use Exportable;

    public function __construct(private int $tenantId) {}

    public function sheets(): array
    {
        return [
            new ProductVariantsSheetExport(),
            new ProductsReferenceSheetExport($this->tenantId),
        ];
    }
}
