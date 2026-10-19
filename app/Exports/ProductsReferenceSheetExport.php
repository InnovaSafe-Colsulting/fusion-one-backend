<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductsReferenceSheetExport implements FromCollection, WithHeadings, WithTitle
{
    public function __construct(private int $tenantId) {}

    public function title(): string { return 'Productos'; }

    public function headings(): array { return ['id', 'nombre']; }

    public function collection(): \Illuminate\Support\Enumerable
    {
        return DB::table('products')
            ->where('tenant_id', $this->tenantId)
            ->where('is_active', 1)
            ->select('id', 'name')
            ->orderBy('name')
            ->get()
            ->map(fn($row) => [$row->id, $row->name]);
    }
}
