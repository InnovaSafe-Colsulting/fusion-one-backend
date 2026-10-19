<?php

namespace App\Repositories\Interfaces\Products;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface PriceListItemRepositoryInterface extends BaseRepositoryInterface
{
    public function allByPriceList(int $priceListId): mixed;
}
