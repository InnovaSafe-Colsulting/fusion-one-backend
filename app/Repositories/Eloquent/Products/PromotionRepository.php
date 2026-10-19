<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Promotion;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\PromotionRepositoryInterface;

class PromotionRepository extends BaseRepository implements PromotionRepositoryInterface
{
    protected function model(): string
    {
        return Promotion::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function allPaginated(array $filters = []): mixed
    {
        $query = $this->query()->withCount('products')->orderBy('name');

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        return $query->paginate(20);
    }

    public function findWithProducts(int $id): mixed
    {
        return $this->query()
            ->with('products:id,name,price')
            ->findOrFail($id);
    }

    public function updateStatus(int $id): mixed
    {
        $record = $this->findById($id);
        $record->update(['is_active' => !$record->is_active]);
        return $record->fresh();
    }
}
