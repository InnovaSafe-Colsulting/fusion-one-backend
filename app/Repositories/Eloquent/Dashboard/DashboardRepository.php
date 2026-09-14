<?php

namespace App\Repositories\Eloquent\Dashboard;

use App\Context\TenantContext;
use App\Repositories\Interfaces\Dashboard\DashboardRepositoryInterface;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function __construct(private TenantContext $tenantContext) {}

    public function all(array $filters = []): mixed
    {
        return [];
    }

    public function findById(int $id): mixed
    {
        return null;
    }

    public function create(array $data): mixed
    {
        return null;
    }

    public function update(int $id, array $data): mixed
    {
        return null;
    }

    public function delete(int $id): bool
    {
        return false;
    }
}
