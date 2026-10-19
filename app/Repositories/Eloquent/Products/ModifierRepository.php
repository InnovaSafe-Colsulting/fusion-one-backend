<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Modifier;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\ModifierRepositoryInterface;

class ModifierRepository extends BaseRepository implements ModifierRepositoryInterface
{
    protected function model(): string
    {
        return Modifier::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function allPaginated(array $filters = []): mixed
    {
        $query = $this->query()->withCount('options')->orderBy('name');

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['selection_type'])) {
            $query->where('selection_type', $filters['selection_type']);
        }

        return $query->paginate(20);
    }

    public function findWithOptions(int $id): mixed
    {
        return $this->query()->with('options')->findOrFail($id);
    }

    public function updateStatus(int $id): mixed
    {
        $record = $this->findById($id);
        $record->update(['is_active' => !$record->is_active]);
        return $record->fresh();
    }
}
