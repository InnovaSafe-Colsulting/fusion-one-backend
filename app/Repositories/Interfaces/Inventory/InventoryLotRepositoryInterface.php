<?php

namespace App\Repositories\Interfaces\Inventory;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface InventoryLotRepositoryInterface extends BaseRepositoryInterface
{
    public function allWithExpiration(): mixed;
    public function findByProduct(int $productId): mixed;
}
