<?php

namespace App\Repositories\Interfaces\Inventory;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface InventoryRepositoryInterface extends BaseRepositoryInterface
{
    public function updateQuantities(int $id, array $data): mixed;
    public function sumAverageCost(): float;
    public function findByProductAndWarehouse(int $productId, int $warehouseId): mixed;
}
