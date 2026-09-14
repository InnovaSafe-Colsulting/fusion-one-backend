<?php

namespace App\Repositories\Interfaces\Admin;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface BranchRepositoryInterface extends BaseRepositoryInterface
{
    public function allActive(): mixed;
}
