<?php

namespace App\Repositories\Interfaces\Inventory;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface WarehouseRepositoryInterface extends BaseRepositoryInterface
{
    public function allActive(): mixed;
    public function findActive(int $id): mixed;
    public function updateStatus(int $id): mixed;
}
