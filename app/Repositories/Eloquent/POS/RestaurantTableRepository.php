<?php

namespace App\Repositories\Eloquent\POS;

use App\Models\RestaurantTable;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\POS\RestaurantTableRepositoryInterface;

class RestaurantTableRepository extends BaseRepository implements RestaurantTableRepositoryInterface
{
    protected function model(): string
    {
        return RestaurantTable::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function allActive(): mixed
    {
        return $this->query()
            ->where('is_active', 1)
            ->orderBy('name')
            ->get(['id', 'name', 'capacity', 'status']);
    }
}