<?php

namespace App\Repositories\Eloquent\Inventory;

use App\Models\InventoryAdjustment;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Inventory\InventoryAdjustmentRepositoryInterface;

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
}