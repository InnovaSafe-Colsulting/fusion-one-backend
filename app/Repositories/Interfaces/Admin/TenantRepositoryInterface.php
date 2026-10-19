<?php

namespace App\Repositories\Interfaces\Admin;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface TenantRepositoryInterface extends BaseRepositoryInterface
{
    public function updateStatus(int $id, int $status): mixed;
}
