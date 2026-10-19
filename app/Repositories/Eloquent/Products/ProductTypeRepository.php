<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\ProductType;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\ProductTypeRepositoryInterface;

class ProductTypeRepository extends BaseRepository implements ProductTypeRepositoryInterface
{
    protected function model(): string
    {
        return ProductType::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function allActive(): mixed
    {
        return $this->query()->where('is_active', 1)->get()->toArray();
    }

    public function findActive(int $id): mixed
    {
        return $this->query()->where('is_active', 1)->where('id', $id)->firstOrFail();
    }

    public function updateStatus(int $id): mixed
    {
        $record = $this->findById($id);
        $record->update(['is_active' => !$record->is_active]);
        return $record->fresh();
    }
}
