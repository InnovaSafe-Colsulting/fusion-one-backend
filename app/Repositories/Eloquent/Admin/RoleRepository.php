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

    public function all(array $filters = []): mixed
    {
        $tenantId = $this->tenantContext->getTenantId();

        return $this->model->newQuery()
            ->where(function ($q) use ($tenantId) {
                $q->where('tenant_id', $tenantId)->orWhereNull('tenant_id');
            })
            ->get();
    }

    public function updateStatus(int $id, bool $isActive): mixed
    {
        $role = $this->model->newQuery()->findOrFail($id);
        $role->update(['is_active' => $isActive]);
        return $role->fresh();
    }

    public function allActive(): mixed
    {
        $tenantId = $this->tenantContext->getTenantId();

        return $this->model->newQuery()
            ->where(function ($q) use ($tenantId) {
                $q->where('tenant_id', $tenantId)->orWhereNull('tenant_id');
            })
            ->where('is_active', true)
            ->select('id', 'name', 'slug')
            ->get();
    }
}