<?php

namespace App\Repositories\Interfaces\Products;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function allWithCategory(array $filters = []): mixed;
    public function count(): int;
}
