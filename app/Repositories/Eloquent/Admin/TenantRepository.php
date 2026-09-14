<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\Tenant;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\TenantRepositoryInterface;

class TenantRepository extends BaseRepository implements TenantRepositoryInterface
{
    protected function model(): string
    {
        return Tenant::class;
    }

    protected function usesTenant(): bool
    {
        return false;
    }
}