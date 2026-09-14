<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\ProductVariant;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\ProductVariantRepositoryInterface;

class ProductVariantRepository extends BaseRepository implements ProductVariantRepositoryInterface
{
    protected function model(): string
    {
        return ProductVariant::class;
    }

    protected function usesTenant(): bool
    {
        return false;
    }
}