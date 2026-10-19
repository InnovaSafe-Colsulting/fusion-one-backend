<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\RolePermissionRepositoryInterface;

class RolePermissionService
{
    public function __construct(private RolePermissionRepositoryInterface $repository) {}

    public function create(array $data): mixed
    {
        return $this->repository->create($data);
    }

    public function getByRoleAndModule(?string $roleId, ?string $moduleId): mixed
    {
        return $this->repository->findByRoleAndModule($roleId, $moduleId);
    }

    public function update(int $id, array $data): mixed
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
