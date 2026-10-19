<?php

namespace App\Repositories\Eloquent\Inventory;

use App\Models\InventoryLot;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Inventory\InventoryLotRepositoryInterface;
use Illuminate\Support\Facades\DB;

class InventoryLotRepository extends BaseRepository implements InventoryLotRepositoryInterface
{
    protected function model(): string
    {
        return InventoryLot::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function allWithExpiration(): mixed
    {
        return $this->buildExpirationQuery()->get();
    }

    public function findByProduct(int $productId): mixed
    {
        return $this->buildExpirationQuery()
            ->where('il.product_id', $productId)
            ->get();
    }

    private function buildExpirationQuery()
    {
        $tenantId = $this->getTenantId();
        $today    = now()->toDateString();

        return DB::table('inventory_lots as il')
            ->join('products as p', 'il.product_id', '=', 'p.id')
            ->join('inventory as inv', function ($join) {
                $join->on('inv.product_id', '=', 'il.product_id')
                     ->on('inv.warehouse_id', '=', 'il.warehouse_id');
            })
            ->where('il.tenant_id', $tenantId)
            ->select(
                'il.id',
                'il.warehouse_id',
                'il.product_id',
                'p.name as product_name',
                'p.sku',
                'il.lot_number',
                'il.quantity',
                'il.expiration_date',
                'il.unit_cost',
                'inv.quantity as stock_quantity',
                DB::raw("CASE
                    WHEN il.expiration_date IS NULL THEN 'no_expiration'
                    WHEN il.expiration_date < '{$today}' THEN 'expired'
                    WHEN il.expiration_date <= DATE_ADD('{$today}', INTERVAL 30 DAY) THEN 'expires_30'
                    WHEN il.expiration_date <= DATE_ADD('{$today}', INTERVAL 60 DAY) THEN 'expires_60'
                    WHEN il.expiration_date <= DATE_ADD('{$today}', INTERVAL 90 DAY) THEN 'expires_90'
                    ELSE 'ok'
                END as expiration_flag")
            )
            ->orderBy('il.expiration_date');
    }
}
