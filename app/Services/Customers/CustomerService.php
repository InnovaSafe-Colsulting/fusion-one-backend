<?php

namespace App\Services\Customers;

use App\Repositories\Interfaces\Customers\CustomerRepositoryInterface;

class CustomerService
{
    public function __construct(private CustomerRepositoryInterface $repository) {}

    public function getAll(array $filters = []): mixed
    {
        return $this->repository->all($filters);
    }

    public function getActive(): mixed
    {
        return $this->repository->allActive();
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