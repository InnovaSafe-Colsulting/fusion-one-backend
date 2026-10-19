<?php

namespace App\Services\Admin;

use App\Enums\PaymentMethodType;
use App\Repositories\Interfaces\Admin\PaymentMethodRepositoryInterface;
use App\Services\CacheService;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Facades\JWTAuth;

class PaymentMethodService
{
    public function __construct(private PaymentMethodRepositoryInterface $repository) {}

    private function tenantId(): int
    {
        return (int) JWTAuth::parseToken()->getPayload()->get('tenantId');
    }

    public function getAll(array $filters = []): mixed
    {
        return $this->repository->all($filters);
    }

    public function getById(int $id): mixed
    {
        return $this->repository->findWithConfigs($id);
    }

    public function create(array $data): mixed
    {
        $result = $this->repository->create($data);
        CacheService::flushPaymentMethods($this->tenantId());
        return $result;
    }

    public function update(int $id, array $data): mixed
    {
        $result = $this->repository->update($id, $data);
        CacheService::flushPaymentMethods($this->tenantId());
        return $result;
    }

    public function delete(int $id): bool
    {
        $result = $this->repository->delete($id);
        CacheService::flushPaymentMethods($this->tenantId());
        return $result;
    }

    public function toggleStatus(int $id, bool $isActive): mixed
    {
        $result = $this->repository->updateStatus($id, $isActive);
        CacheService::flushPaymentMethods($this->tenantId());
        return $result;
    }

    public function getActive(): mixed
    {
        $key = CacheService::paymentMethodsActiveKey($this->tenantId());
        return CacheService::remember($key, CacheService::TTL_SHORT, fn() => $this->repository->allActive());
    }

    public function getTypes(): array
    {
        return collect(PaymentMethodType::cases())->map(fn($case) => [
            'value' => $case->value,
            'label' => $case->label(),
        ])->values()->toArray();
    }
}
