<?php

namespace App\Services\Products;

use App\Repositories\Interfaces\Products\PriceListRepositoryInterface;

class PriceListService
{
    public function __construct(private PriceListRepositoryInterface $repository) {}

    public function getAll(): mixed
    {
        return $this->repository->allActive();
    }

    public function getById(int $id): mixed
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): mixed
    {
        if (!empty($data['is_default'])) {
            $this->repository->clearDefault();
        }
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): mixed
    {
        if (!empty($data['is_default'])) {
            $this->repository->clearDefault($id);
        }
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
