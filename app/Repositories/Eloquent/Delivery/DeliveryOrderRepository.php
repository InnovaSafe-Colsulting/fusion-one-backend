<?php

namespace App\Repositories\Eloquent\Delivery;

use App\Models\DeliveryOrder;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Delivery\DeliveryOrderRepositoryInterface;

class DeliveryOrderRepository extends BaseRepository implements DeliveryOrderRepositoryInterface
{
    protected function model(): string
    {
        return DeliveryOrder::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}