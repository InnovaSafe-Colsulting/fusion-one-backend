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
            ->where('is_active', true)
            ->select('id', 'name', 'code', 'address', 'phone', 'email', 'city_id')
            ->get();
    }
}