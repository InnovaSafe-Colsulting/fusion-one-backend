<?php

namespace App\Services\Products;

use App\Repositories\Interfaces\Products\ComboRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ComboService
{
    public function __construct(private ComboRepositoryInterface $repository) {}

    public function getAll(array $filters = []): mixed
    {
        return $this->repository->allPaginated($filters);
    }

    public function getActive(): array
    {
        return $this->repository->allActive();
    }

    public function getById(int $id): mixed
    {
        return $this->repository->findWithItems($id);
    }

    public function create(array $data): mixed
    {
        return DB::transaction(function () use ($data) {
            $combo = $this->repository->create($data);

            if (!empty($data['items'])) {
                foreach ($data['items'] as $item) {
                    $combo->items()->create([
                        'product_id' => $item['product_id'],
                        'quantity'   => $item['quantity'] ?? 1,
                    ]);
                }
            }

            return $combo->load('items.product:id,name,price');
        });
    }

    public function update(int $id, array $data): mixed
    {
        return DB::transaction(function () use ($id, $data) {
            $combo = $this->repository->update($id, $data);

            if (isset($data['items'])) {
                $combo->items()->delete();
                foreach ($data['items'] as $item) {
                    $combo->items()->create([
                        'product_id' => $item['product_id'],
                        'quantity'   => $item['quantity'] ?? 1,
                    ]);
                }
            }

            return $combo->load('items.product:id,name,price');
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
