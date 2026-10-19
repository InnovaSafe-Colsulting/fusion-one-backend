<?php

namespace App\Services\Products;

use App\Enums\PriceListEntityType;
use App\Repositories\Interfaces\Products\PriceListItemRepositoryInterface;

class PriceListItemService
{
    public function __construct(private PriceListItemRepositoryInterface $repository) {}

    public function getAllByPriceList(int $priceListId): mixed
    {
        return $this->repository->allByPriceList($priceListId);
    }

    public function getById(int $id): mixed
    {
        return $this->repository->findById($id);
    }

    public function create(array $data): mixed
    {
        $data['entity_type'] = PriceListEntityType::from($data['entity_type'])->toModelClass();
        return $this->repository->create($data);
    }

    public function update(int $id, array $data): mixed
    {
        if (isset($data['entity_type'])) {
            $data['entity_type'] = PriceListEntityType::from($data['entity_type'])->toModelClass();
        }
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
