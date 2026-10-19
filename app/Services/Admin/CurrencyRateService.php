<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\CurrencyRateRepositoryInterface;

class CurrencyRateService
{
    public function __construct(private CurrencyRateRepositoryInterface $repository) {}

    public function getAll(): mixed
    {
        return $this->repository->all();
    }

    public function create(array $data): mixed
    {
        return $this->repository->create($data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
