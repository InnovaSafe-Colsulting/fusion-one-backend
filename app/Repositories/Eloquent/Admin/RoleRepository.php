<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\Role;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\RoleRepositoryInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    protected function model(): string
    {
        return Role::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}