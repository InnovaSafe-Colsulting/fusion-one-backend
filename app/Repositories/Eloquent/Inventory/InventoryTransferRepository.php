<?php

namespace App\Repositories\Eloquent\Inventory;

use App\Models\InventoryTransfer;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Inventory\InventoryTransferRepositoryInterface;

class InventoryTransferRepository extends BaseRepository implements InventoryTransferRepositoryInterface
{
    protected function model(): string
    {
        return InventoryTransfer::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}