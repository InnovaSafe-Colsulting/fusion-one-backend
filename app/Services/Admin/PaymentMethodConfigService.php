<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\PaymentMethodConfigRepositoryInterface;

class PaymentMethodConfigService
{
    public function __construct(private PaymentMethodConfigRepositoryInterface $repository) {}

    public function getByPaymentMethod(int $paymentMethodId): mixed
    {
        return $this->repository->findByPaymentMethod($paymentMethodId);
    }

    public function getById(int $id): mixed
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): mixed
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): mixed
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
