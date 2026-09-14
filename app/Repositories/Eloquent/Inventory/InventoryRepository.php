<?php

namespace App\Repositories\Eloquent\Inventory;

use App\Models\Inventory;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Inventory\InventoryRepositoryInterface;

class InventoryRepository extends BaseRepository implements InventoryRepositoryInterface
{
    protected function model(): string
    {
        return Inventory::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}