<?php

namespace App\Repositories\Eloquent\Kitchen;

use App\Models\KitchenOrder;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Kitchen\KitchenOrderRepositoryInterface;

class KitchenOrderRepository extends BaseRepository implements KitchenOrderRepositoryInterface
{
    protected function model(): string
    {
        return KitchenOrder::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}