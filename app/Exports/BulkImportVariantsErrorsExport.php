<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\Export;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BulkImportVariantsErrorsExport implements Export, FromCollection, WithHeadings
{
    use Exportable;

    public function __construct(private string $batch) {}

    public function headings(): array
    {
        return ['product_id', 'nombre', 'sku', 'barcode', 'precio', 'costo', 'estado', 'error'];
    }

    public function collection(): Collection
    {
        return DB::table('tmp_product_variants')
            ->where('import_batch', $this->batch)
            ->whereNotNull('error')
            ->get()
            ->map(fn($row) => [
                $row->product_id, $row->name, $row->sku,
                $row->barcode, $row->price, $row->cost,
                $row->is_active, $row->error,
            ]);
    }
}
