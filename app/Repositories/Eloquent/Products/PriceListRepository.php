<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\PriceList;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\PriceListRepositoryInterface;

class PriceListRepository extends BaseRepository implements PriceListRepositoryInterface
{
    protected function model(): string
    {
        return PriceList::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}