<?php

namespace App\Repositories\Interfaces\Products;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function allActive(): mixed;
    public function allWithTenant(): mixed;
    public function updateStatus(int $id): mixed;
}
