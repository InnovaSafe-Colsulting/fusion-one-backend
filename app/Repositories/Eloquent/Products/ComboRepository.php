<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Combo;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\ComboRepositoryInterface;

class ComboRepository extends BaseRepository implements ComboRepositoryInterface
{
    protected function model(): string
    {
        return Combo::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function allPaginated(array $filters = []): mixed
    {
        $query = $this->query()->withCount('items')->orderBy('name');

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $query->paginate(20);
    }

    public function allActive(): array
    {
        return $this->query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->toArray();
    }

    public function findWithItems(int $id): mixed
    {
        return $this->query()
            ->with(['items.product:id,name,price'])
            ->findOrFail($id);
    }

    public function updateStatus(int $id): mixed
    {
        $record = $this->findById($id);
        $record->update(['is_active' => !$record->is_active]);
        return $record->fresh();
    }
}
