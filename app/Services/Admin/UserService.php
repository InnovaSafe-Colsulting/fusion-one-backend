<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\UserRepositoryInterface;

class UserService
{
    public function __construct(private UserRepositoryInterface $repository) {}

    public function getAll(array $filters = []): mixed
    {
        return $this->repository->allWithRelations();
    }

    public function getById(int $id): mixed
    {
        return $this->repository->findWithRelations($id);
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
}