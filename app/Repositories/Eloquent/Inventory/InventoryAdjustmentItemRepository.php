<?php

namespace App\Repositories\Eloquent\Inventory;

use App\Models\InventoryAdjustmentItem;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Inventory\InventoryAdjustmentItemRepositoryInterface;

class InventoryAdjustmentItemRepository extends BaseRepository implements InventoryAdjustmentItemRepositoryInterface
{
    protected function model(): string
    {
        return InventoryAdjustmentItem::class;
    }

    protected function usesTenant(): bool
    {
        return false;
    }
}
