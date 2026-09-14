<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Ingredient;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\IngredientRepositoryInterface;

class IngredientRepository extends BaseRepository implements IngredientRepositoryInterface
{
    protected function model(): string
    {
        return Ingredient::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}