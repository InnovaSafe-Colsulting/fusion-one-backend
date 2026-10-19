<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\RolePermission;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\RolePermissionRepositoryInterface;

class RolePermissionRepository extends BaseRepository implements RolePermissionRepositoryInterface
{
    protected function model(): string
    {
        return RolePermission::class;
    }

    protected function usesTenant(): bool
    {
        return false;
    }

    public function findByRoleAndModule(?string $roleId, ?string $moduleId): mixed
    {
        return $this->model->newQuery()
            ->with(['role:id,name,slug', 'permission:id,name,action', 'module:id,name,slug'])
            ->when($roleId, fn($q) => $q->where('role_id', $roleId))
            ->when($moduleId, fn($q) => $q->where('module_id', $moduleId))
            ->get();
    }
}
