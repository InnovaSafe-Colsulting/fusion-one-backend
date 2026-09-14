<?php

namespace App\Repositories\Eloquent\POS;

use App\Models\Order;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\POS\OrderRepositoryInterface;

class OrderRepository extends BaseRepository implements OrderRepositoryInterface
{
    protected function model(): string
    {
        return Order::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}