<?php

namespace App\Services\Inventory;

use App\Repositories\Interfaces\Inventory\InventoryRepositoryInterface;

class InventoryService
{
    public function __construct(private InventoryRepositoryInterface $repository) {}

    public function getAll(array $filters = []): mixed
    {
        return $this->repository->all($filters);
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

    public function updateQuantities(int $id, array $data): mixed
    {
        return $this->repository->updateQuantities($id, $data);
    }

    public function getTotalAverageCost(): float
    {
        return $this->repository->sumAverageCost();
    }

    public function getByProductAndWarehouse(int $productId, int $warehouseId): mixed
    {
        return $this->repository->findByProductAndWarehouse($productId, $warehouseId);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
