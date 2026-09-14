<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Product;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected function model(): string
    {
        return Product::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}