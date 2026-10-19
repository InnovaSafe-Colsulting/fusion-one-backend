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

    public function allPaginated(array $filters = []): mixed
    {
        $query = $this->query()->withCount('ingredients')->orderBy('name');

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $query->paginate(20);
    }

    public function findWithIngredients(int $id): mixed
    {
        return $this->query()
            ->with(['ingredients.ingredient:id,name,unit'])
            ->findOrFail($id);
    }

    public function updateStatus(int $id): mixed
    {
        $record = $this->findById($id);
        $record->update(['is_active' => !$record->is_active]);
        return $record->fresh();
    }
}
