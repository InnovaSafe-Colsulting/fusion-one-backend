<?php

namespace App\Repositories\Eloquent\Purchases;

use App\Models\PurchaseReceipt;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Purchases\PurchaseReceiptRepositoryInterface;

class PurchaseReceiptRepository extends BaseRepository implements PurchaseReceiptRepositoryInterface
{
    protected function model(): string
    {
        return PurchaseReceipt::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}