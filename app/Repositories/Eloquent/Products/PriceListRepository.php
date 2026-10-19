<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\PriceList;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\PriceListRepositoryInterface;

class PriceListRepository extends BaseRepository implements PriceListRepositoryInterface
{
    protected function model(): string
    {
        return PriceList::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function allActive(): mixed
    {
        return $this->query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function findById(int $id): mixed
    {
        return $this->query()
            ->where('is_active', true)
            ->findOrFail($id);
    }

    public function updateStatus(int $id): mixed
    {
        $record = $this->query()->findOrFail($id);
        $record->update(['is_active' => !$record->is_active]);
        return $record->fresh();
    }

    public function clearDefault(?int $excludeId = null): void
    {
        $q = $this->query();
        if ($excludeId) {
            $q->where('id', '!=', $excludeId);
        }
        $q->update(['is_default' => false]);
    }

    public function setDefault(int $id): mixed
    {
        $this->query()->update(['is_default' => false]);
        $record = $this->query()->findOrFail($id);
        $record->update(['is_default' => true]);
        return $record->fresh();
    }
}
