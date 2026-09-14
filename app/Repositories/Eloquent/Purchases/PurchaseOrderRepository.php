<?php

namespace App\Repositories\Eloquent\Purchases;

use App\Models\PurchaseOrder;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Purchases\PurchaseOrderRepositoryInterface;

class PurchaseOrderRepository extends BaseRepository implements PurchaseOrderRepositoryInterface
{
    protected function model(): string
    {
        return PurchaseOrder::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}