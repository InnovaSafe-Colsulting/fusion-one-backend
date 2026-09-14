<?php

namespace App\Repositories\Eloquent\POS;

use App\Models\Payment;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\POS\PaymentRepositoryInterface;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    protected function model(): string
    {
        return Payment::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}