<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\PaymentMethod;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\PaymentMethodRepositoryInterface;

class PaymentMethodRepository extends BaseRepository implements PaymentMethodRepositoryInterface
{
    protected function model(): string
    {
        return PaymentMethod::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}