<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\Branch;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\BranchRepositoryInterface;

class BranchRepository extends BaseRepository implements BranchRepositoryInterface
{
    protected function model(): string
    {
        return Branch::class;
    }

    public function allActive(): mixed
    {
        return $this->query()
            ->with('city:id,name')
            ->where('is_active', true)
            ->select('id', 'name', 'code', 'address', 'phone', 'email', 'city_id', 'is_active')
            ->get();
    }

    public function allWithCity(): mixed
    {
        return $this->query()
            ->with('city:id,name')
            ->select('id', 'tenant_id', 'name', 'code', 'address', 'phone', 'email', 'city_id', 'is_active')
            ->get();
    }

    public function findWithCity(int $id): mixed
    {
        return $this->query()
            ->with('city:id,name')
            ->select('id', 'tenant_id', 'name', 'code', 'address', 'phone', 'email', 'city_id', 'is_active')
            ->findOrFail($id);
    }

    public function updateStatus(int $id, bool $isActive): mixed
    {
        $branch = $this->query()->findOrFail($id);
        $branch->update(['is_active' => $isActive]);
        return $branch->fresh();
    }
}