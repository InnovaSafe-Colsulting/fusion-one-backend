<?php

namespace App\Services\Products;

use App\Repositories\Interfaces\Products\IngredientRepositoryInterface;

class IngredientService
{
    public function __construct(private IngredientRepositoryInterface $repository) {}

    public function getAll(array $filters = []): mixed
    {
        return $this->repository->all($filters);
    }

    public function getActive(): mixed
    {
        return $this->repository->allActive();
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
