<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\PaymentMethodConfig;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\PaymentMethodConfigRepositoryInterface;

class PaymentMethodConfigRepository extends BaseRepository implements PaymentMethodConfigRepositoryInterface
{
    protected function model(): string
    {
        return PaymentMethodConfig::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function findByPaymentMethod(int $paymentMethodId): mixed
    {
        return $this->query()
            ->where('payment_method_id', $paymentMethodId)
            ->where('is_active', 1)
            ->get();
    }
}
