<?php

namespace App\Services\Products;

use App\Repositories\Interfaces\Products\PromotionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PromotionService
{
    public function __construct(private PromotionRepositoryInterface $repository) {}

    public function getAll(array $filters = []): mixed
    {
        return $this->repository->allPaginated($filters);
    }

    public function getById(int $id): mixed
    {
        return $this->repository->findWithProducts($id);
    }

    public function create(array $data): mixed
    {
        return DB::transaction(function () use ($data) {
            $promotion = $this->repository->create($data);

            if (!empty($data['products'])) {
                $promotion->products()->sync($data['products']);
            }

            return $promotion->load('products:id,name,price');
        });
    }

    public function update(int $id, array $data): mixed
    {
        return DB::transaction(function () use ($id, $data) {
            $promotion = $this->repository->update($id, $data);

            if (isset($data['products'])) {
                $promotion->products()->sync($data['products']);
            }

            return $promotion->load('products:id,name,price');
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
