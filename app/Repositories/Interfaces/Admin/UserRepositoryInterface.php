<?php

namespace App\Repositories\Interfaces\Admin;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function allWithRelations(): mixed;
    public function findWithRelations(int $id): mixed;
    public function updateStatus(int $id, bool $isActive): mixed;
}
