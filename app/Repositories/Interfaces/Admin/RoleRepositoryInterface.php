<?php

namespace App\Repositories\Interfaces\Admin;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface RoleRepositoryInterface extends BaseRepositoryInterface
{
    public function updateStatus(int $id, bool $isActive): mixed;
    public function allActive(): mixed;
}
