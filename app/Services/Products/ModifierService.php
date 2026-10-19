<?php

namespace App\Services\Products;

use App\Repositories\Interfaces\Products\ModifierRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ModifierService
{
    public function __construct(private ModifierRepositoryInterface $repository) {}

    public function getAll(array $filters = []): mixed
    {
        return $this->repository->allPaginated($filters);
    }

    public function getById(int $id): mixed
    {
        return $this->repository->findWithOptions($id);
    }

    public function create(array $data): mixed
    {
        return DB::transaction(function () use ($data) {
            $modifier = $this->repository->create($data);

            if (!empty($data['options'])) {
                foreach ($data['options'] as $option) {
                    $modifier->options()->create([
                        'name'      => $option['name'],
                        'price'     => $option['price'] ?? 0,
                        'is_active' => $option['is_active'] ?? true,
                    ]);
                }
            }

            return $modifier->load('options');
        });
    }

    public function update(int $id, array $data): mixed
    {
        return DB::transaction(function () use ($id, $data) {
            $modifier = $this->repository->update($id, $data);

            if (isset($data['options'])) {
                $modifier->options()->delete();
                foreach ($data['options'] as $option) {
                    $modifier->options()->create([
                        'name'      => $option['name'],
                        'price'     => $option['price'] ?? 0,
                        'is_active' => $option['is_active'] ?? true,
                    ]);
                }
            }

            return $modifier->load('options');
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
