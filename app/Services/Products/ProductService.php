<?php

namespace App\Services\Products;

use App\Repositories\Interfaces\Products\ProductRepositoryInterface;
use App\Services\CacheService;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductService
{
    public function __construct(private ProductRepositoryInterface $repository) {}

    private function tenantId(): int
    {
        return (int) JWTAuth::parseToken()->getPayload()->get('tenantId');
    }

    public function getAll(array $filters = []): mixed
    {
        return $this->repository->allWithCategory($filters);
    }

    public function getCount(): int
    {
        return $this->repository->count();
    }

    public function getById(int $id): mixed
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): mixed
    {
        $result = $this->repository->create($data);
        CacheService::flushProducts($this->tenantId());
        return $result;
    }

    public function update(int $id, array $data): mixed
    {
        $result = $this->repository->update($id, $data);
        CacheService::flushProducts($this->tenantId());
        return $result;
    }

    public function delete(int $id): bool
    {
        $result = $this->repository->delete($id);
        CacheService::flushProducts($this->tenantId());
        return $result;
    }
}
