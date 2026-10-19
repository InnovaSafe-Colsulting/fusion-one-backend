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

    public function allActive(): mixed
    {
        return $this->query()
            ->where('is_active', true)
            ->select('id', 'name')
            ->orderBy('name')
            ->get()->toArray();
    }

    public function allWithTenant(): mixed
    {
        return $this->query()
            ->join('tenants', 'tenants.id', '=', 'categories.tenant_id')
            ->where('categories.is_active', 1)
            ->where('tenants.status', 1)
            ->with('parent:id,name')
            ->select('categories.*')
            ->orderBy('categories.name')
            ->get()->toArray();
    }

    public function updateStatus(int $id): mixed
    {
        $record = $this->findById($id);
        $record->update(['is_active' => !$record->is_active]);
        return $record->fresh();
    }
}
