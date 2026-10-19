<?php

namespace App\Repositories\Eloquent\Inventory;

use App\Models\WarehouseType;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Inventory\WarehouseTypeRepositoryInterface;

class WarehouseTypeRepository extends BaseRepository implements WarehouseTypeRepositoryInterface
{
    protected function model(): string
    {
        return WarehouseType::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function allActive(): mixed
    {
        return $this->query()->where('is_active', 1)->orderBy('name')->get();
    }

    public function findActive(int $id): mixed
    {
        return $this->query()->where('is_active', 1)->findOrFail($id);
    }

    public function updateStatus(int $id): mixed
    {
        $record = $this->query()->findOrFail($id);
        $record->update(['is_active' => !$record->is_active]);
        return $record->fresh();
    }
}
