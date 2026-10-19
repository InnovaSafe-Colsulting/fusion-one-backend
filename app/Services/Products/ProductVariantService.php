<?php

namespace App\Services\Products;

use App\Repositories\Interfaces\Products\ProductVariantRepositoryInterface;

class ProductVariantService
{
    public function __construct(private ProductVariantRepositoryInterface $repository) {}

    public function getAllByProduct(int $productId): mixed
    {
        return $this->repository->allByProduct($productId);
    }

    public function getAll(array $filters = []): mixed
    {
        return $this->repository->allVariants($filters);
    }

    public function getById(int $id): mixed
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): mixed
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): mixed
    {
        return $this->repository->update($id, $data);
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
