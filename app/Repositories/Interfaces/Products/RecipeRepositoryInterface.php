<?php

namespace App\Repositories\Interfaces\Products;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface RecipeRepositoryInterface extends BaseRepositoryInterface
{
    public function allPaginated(array $filters = []): mixed;
    public function findWithIngredients(int $id): mixed;
    public function updateStatus(int $id): mixed;
}
