<?php

namespace App\Repositories\Interfaces\Products;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface ProductVariantRepositoryInterface extends BaseRepositoryInterface
{
    public function allVariants(): mixed;
    public function allByProduct(int $productId): mixed;
    public function updateStatus(int $id): mixed;
}
