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

    public function all(array $filters = []): mixed
    {
        $query = $this->model->newQuery()
            ->leftJoin('categories', 'categories.id', '=', 'ingredients.category_id')
            ->where('ingredients.tenant_id', $this->getTenantId())
            ->select(
                'ingredients.id', 'ingredients.name', 'ingredients.sku',
                'ingredients.unit', 'ingredients.cost', 'ingredients.is_active',
                'ingredients.category_id', 'categories.name as category_name'
            )
            ->orderBy('ingredients.name');

        if (!empty($filters['name'])) {
            $query->where('ingredients.name', 'like', '%' . $filters['name'] . '%');
        }

        return $query->paginate(20);
    }

    public function allActive(): mixed
    {
        return $this->query()
            ->select('id', 'name', 'sku', 'unit', 'cost')
            ->where('is_active', 1)
            ->orderBy('name')
            ->get()->toArray();
    }

    public function updateStatus(int $id): mixed
    {
        $record = $this->findById($id);
        $record->update(['is_active' => !$record->is_active]);
        return $record->fresh();
    }
}
