<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\CurrencyRepositoryInterface;
use App\Services\CacheService;
use Illuminate\Support\Facades\Cache;

class CurrencyService
{
    public function __construct(private CurrencyRepositoryInterface $repository) {}

    public function getAll(array $filters = []): mixed
    {
        return CacheService::remember(CacheService::currenciesKey(), CacheService::TTL_LONG, fn() => $this->repository->all($filters));
    }

    public function getById(int $id): mixed
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): mixed
    {
        $result = $this->repository->create($data);
        CacheService::flushCurrencies();
        return $result;
    }

    public function update(int $id, array $data): mixed
    {
        $result = $this->repository->update($id, $data);
        CacheService::flushCurrencies();
        return $result;
    }

    public function delete(int $id): bool
    {
        $result = $this->repository->delete($id);
        CacheService::flushCurrencies();
        return $result;
    }

    public function updateStatus(int $id): mixed
    {
        $result = $this->repository->updateStatus($id);
        CacheService::flushCurrencies();
        return $result;
    }

    public function setDefault(int $id): mixed
    {
        $result = $this->repository->setDefault($id);
        CacheService::flushCurrencies();
        return $result;
    }

    public function types(): mixed
    {
        return CacheService::remember(CacheService::currenciesTypesKey(), CacheService::TTL_LONG, fn() => $this->repository->types());
    }
}
