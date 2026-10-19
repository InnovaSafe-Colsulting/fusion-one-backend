<?php

namespace App\Repositories\Interfaces\Admin;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface RolePermissionRepositoryInterface extends BaseRepositoryInterface
{
    public function findByRoleAndModule(?string $roleId, ?string $moduleId): mixed;
}
