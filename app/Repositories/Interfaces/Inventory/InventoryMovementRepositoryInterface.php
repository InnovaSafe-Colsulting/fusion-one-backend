<?php

namespace App\Repositories\Interfaces\Inventory;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface InventoryMovementRepositoryInterface extends BaseRepositoryInterface
{
    public function updateByReferenceId(int $inventoryId, array $data): int;
}
