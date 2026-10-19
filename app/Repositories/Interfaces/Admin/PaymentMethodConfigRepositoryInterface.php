<?php

namespace App\Repositories\Interfaces\Admin;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface PaymentMethodConfigRepositoryInterface extends BaseRepositoryInterface
{
    public function findByPaymentMethod(int $paymentMethodId): mixed;
}
