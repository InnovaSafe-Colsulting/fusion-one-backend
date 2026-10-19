<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\Permission;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\PermissionRepositoryInterface;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    protected function model(): string
    {
        return Permission::class;
    }

    protected function usesTenant(): bool
    {
        return false;
    }

    public function updateStatus(int $id, bool $isActive): mixed
    {
        $permission = $this->model->newQuery()->findOrFail($id);
        $permission->update(['is_active' => $isActive]);
        return $permission->fresh();
    }
}