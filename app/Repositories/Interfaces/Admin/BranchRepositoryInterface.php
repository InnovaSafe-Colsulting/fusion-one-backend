<?php

namespace App\Repositories\Interfaces\Admin;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface BranchRepositoryInterface extends BaseRepositoryInterface
{
    public function allActive(): mixed;
    public function allWithCity(): mixed;
    public function findWithCity(int $id): mixed;
    public function updateStatus(int $id, bool $isActive): mixed;
}
