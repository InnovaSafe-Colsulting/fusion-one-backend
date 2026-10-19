<?php

namespace App\Repositories\Eloquent\Inventory;

use App\Models\Inventory;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Inventory\InventoryRepositoryInterface;

class InventoryRepository extends BaseRepository implements InventoryRepositoryInterface
{
    protected function model(): string
    {
        return Inventory::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function updateQuantities(int $id, array $data): mixed
    {
        $record = $this->query()->findOrFail($id);
        $record->update($data);
        return $record->fresh();
    }

    public function sumAverageCost(): float
    {
        return (float) $this->query()->sum('average_cost');
    }

    public function findByProductAndWarehouse(int $productId, int $warehouseId): mixed
    {
        return $this->query()
            ->where('product_id', $productId)
            ->where('warehouse_id', $warehouseId)
            ->first();
    }
}
