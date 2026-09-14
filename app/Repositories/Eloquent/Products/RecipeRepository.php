<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Recipe;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\RecipeRepositoryInterface;

class RecipeRepository extends BaseRepository implements RecipeRepositoryInterface
{
    protected function model(): string
    {
        return Recipe::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}