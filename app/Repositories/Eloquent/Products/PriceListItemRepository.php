<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\PriceListItem;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\PriceListItemRepositoryInterface;

class PriceListItemRepository extends BaseRepository implements PriceListItemRepositoryInterface
{
    protected function model(): string
    {
        return PriceListItem::class;
    }

    protected function usesTenant(): bool
    {
        return false;
    }

    public function allByPriceList(int $priceListId): mixed
    {
        return $this->model->newQuery()
            ->where('price_list_id', $priceListId)
            ->get();
    }
}
