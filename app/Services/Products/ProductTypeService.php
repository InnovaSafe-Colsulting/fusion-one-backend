<?php

namespace App\Services\Products;

use App\Repositories\Interfaces\Products\ProductTypeRepositoryInterface;
use App\Services\CacheService;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductTypeService
{
    public function __construct(private ProductTypeRepositoryInterface $repository) {}

    private function tenantId(): int
    {
        return (int) JWTAuth::parseToken()->getPayload()->get('tenantId');
    }

    public function getAll(): mixed
    {
        $key = CacheService::productTypesKey($this->tenantId());
        return CacheService::remember($key, CacheService::TTL_LONG, fn() => $this->repository->allActive());
    }

    public function getById(int $id): mixed
    {
        return $this->repository->findActive($id);
    }

    public function create(array $data): mixed
    {
        $result = $this->repository->create($data);
        CacheService::flushProductTypes($this->tenantId());
        return $result;
    }

    public function update(int $id, array $data): mixed
    {
        $result = $this->repository->update($id, $data);
        CacheService::flushProductTypes($this->tenantId());
        return $result;
    }

    public function updateStatus(int $id): mixed
    {
        $result = $this->repository->updateStatus($id);
        CacheService::flushProductTypes($this->tenantId());
        return $result;
    }

    public function delete(int $id): bool
    {
        $result = $this->repository->delete($id);
        CacheService::flushProductTypes($this->tenantId());
        return $result;
    }
}
