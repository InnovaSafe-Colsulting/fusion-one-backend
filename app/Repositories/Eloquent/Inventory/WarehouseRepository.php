<?php

namespace App\Repositories\Eloquent\Inventory;

use App\Models\Warehouse;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Inventory\WarehouseRepositoryInterface;

class WarehouseRepository extends BaseRepository implements WarehouseRepositoryInterface
{
    protected function model(): string
    {
        return Warehouse::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}