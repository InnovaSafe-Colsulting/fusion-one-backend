<?php

namespace App\Repositories\Interfaces\Products;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface PriceListRepositoryInterface extends BaseRepositoryInterface
{
    public function allActive(): mixed;
    public function updateStatus(int $id): mixed;
    public function setDefault(int $id): mixed;
    public function clearDefault(?int $excludeId = null): void;
}
