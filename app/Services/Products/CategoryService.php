<?php

namespace App\Services\Products;

use App\Repositories\Interfaces\Products\CategoryRepositoryInterface;
use App\Services\CacheService;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Facades\JWTAuth;

class CategoryService
{
    public function __construct(private CategoryRepositoryInterface $repository) {}

    private function tenantId(): int
    {
        return (int) JWTAuth::parseToken()->getPayload()->get('tenantId');
    }

    public function getActive(): mixed
    {
        $key = CacheService::categoriesActiveKey($this->tenantId());
        return CacheService::remember($key, CacheService::TTL_LONG, fn() => $this->repository->allActive());
    }

    public function getAll(): mixed
    {
        $key = CacheService::categoriesKey($this->tenantId());
        return CacheService::remember($key, CacheService::TTL_SHORT, fn() => $this->repository->allWithTenant());
    }

    public function getById(int $id): mixed
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): mixed
    {
        $result = $this->repository->create($data);
        CacheService::flushCategories($this->tenantId());
        return $result;
    }

    public function update(int $id, array $data): mixed
    {
        $result = $this->repository->update($id, $data);
        CacheService::flushCategories($this->tenantId());
        return $result;
    }

    public function delete(int $id): bool
    {
        $result = $this->repository->delete($id);
        CacheService::flushCategories($this->tenantId());
        return $result;
    }

    public function updateStatus(int $id): mixed
    {
        $result = $this->repository->updateStatus($id);
        CacheService::flushCategories($this->tenantId());
        return $result;
    }
}
