<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BulkImportErrorsExport implements Export, FromCollection, WithHeadings
{
    use Exportable;

    public function __construct(private string $batch) {}

    public function headings(): array
    {
        return ['nombre', 'sku', 'barcode', 'descripcion', 'costo', 'precio', 'estado', 'category_id', 'type_product_id', 'error'];
    }

    public function collection(): Collection
    {
        return DB::table('tmp_products')
            ->where('import_batch', $this->batch)
            ->whereNotNull('error')
            ->get()
            ->map(fn($row) => [
                $row->name,
                $row->sku,
                $row->barcode,
                $row->description,
                $row->cost,
                $row->price,
                $row->is_active,
                $row->category_id,
                $row->type_product_id,
                $row->error,
            ]);
    }
}
