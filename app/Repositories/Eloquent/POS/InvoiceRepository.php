<?php

namespace App\Repositories\Eloquent\POS;

use App\Models\Invoice;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\POS\InvoiceRepositoryInterface;

class InvoiceRepository extends BaseRepository implements InvoiceRepositoryInterface
{
    protected function model(): string
    {
        return Invoice::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}