<?php

namespace App\Repositories\Eloquent\Inventory;

use App\Models\InventoryAdjustment;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Inventory\InventoryAdjustmentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class InventoryAdjustmentRepository extends BaseRepository implements InventoryAdjustmentRepositoryInterface
{
    protected function model(): string
    {
        return InventoryAdjustment::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function itemsWithActiveAdjustment(): mixed
    {
        return DB::table('inventory_adjustment_items as iai')
            ->join('inventory_adjustments as ia', 'iai.adjustment_id', '=', 'ia.id')
            ->where('ia.status', '1')
            ->where('ia.tenant_id', $this->getTenantId())
            ->select('iai.id', 'iai.adjustment_id', 'iai.product_id', 'iai.new_quantity')
            ->get();
    }
}
