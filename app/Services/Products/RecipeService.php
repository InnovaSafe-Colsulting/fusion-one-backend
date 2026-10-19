<?php

namespace App\Services\Products;

use App\Repositories\Interfaces\Products\RecipeRepositoryInterface;
use Illuminate\Support\Facades\DB;

class RecipeService
{
    public function __construct(private RecipeRepositoryInterface $repository) {}

    public function getAll(array $filters = []): mixed
    {
        return $this->repository->allPaginated($filters);
    }

    public function getById(int $id): mixed
    {
        return $this->repository->findWithIngredients($id);
    }

    public function create(array $data): mixed
    {
        return DB::transaction(function () use ($data) {
            $ingredients = $data['ingredients'] ?? [];
            unset($data['ingredients']);

            $recipe = $this->repository->create($data);

            if (!empty($ingredients)) {
                $recipe->ingredients()->createMany($ingredients);
            }

            return $recipe->load('ingredients.ingredient:id,name,unit');
        });
    }

    public function update(int $id, array $data): mixed
    {
        return DB::transaction(function () use ($id, $data) {
            $ingredients = $data['ingredients'] ?? null;
            unset($data['ingredients']);

            $recipe = $this->repository->update($id, $data);

            if ($ingredients !== null) {
                $recipe->ingredients()->delete();
                $recipe->ingredients()->createMany($ingredients);
            }

            return $recipe->load('ingredients.ingredient:id,name,unit');
        });
    }

    public function updateStatus(int $id): mixed
    {
        return $this->repository->updateStatus($id);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
