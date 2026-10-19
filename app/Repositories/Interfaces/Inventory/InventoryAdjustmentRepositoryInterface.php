<?php

namespace App\Repositories\Interfaces\Inventory;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface InventoryAdjustmentRepositoryInterface extends BaseRepositoryInterface
{
    public function itemsWithActiveAdjustment(): mixed;
}
