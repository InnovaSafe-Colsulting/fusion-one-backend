<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Category;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected function model(): string
    {
        return Category::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}