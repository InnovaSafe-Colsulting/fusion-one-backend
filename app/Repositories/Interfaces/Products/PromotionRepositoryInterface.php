<?php

namespace App\Repositories\Interfaces\Products;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface PromotionRepositoryInterface extends BaseRepositoryInterface
{
    public function allPaginated(array $filters = []): mixed;
    public function findWithProducts(int $id): mixed;
    public function updateStatus(int $id): mixed;
}
