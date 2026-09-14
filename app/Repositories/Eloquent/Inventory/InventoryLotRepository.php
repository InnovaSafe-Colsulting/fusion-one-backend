<?php

namespace App\Repositories\Eloquent\Inventory;

use App\Models\InventoryLot;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Inventory\InventoryLotRepositoryInterface;

class InventoryLotRepository extends BaseRepository implements InventoryLotRepositoryInterface
{
    protected function model(): string
    {
        return InventoryLot::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}