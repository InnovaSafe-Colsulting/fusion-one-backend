<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\RoleRepositoryInterface;

class RoleService
{
    public function __construct(private RoleRepositoryInterface $repository) {}

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

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function toggleStatus(int $id, bool $isActive): mixed
    {
        return $this->repository->updateStatus($id, $isActive);
    }

    public function getActive(): mixed
    {
        return $this->repository->allActive();
    }
}