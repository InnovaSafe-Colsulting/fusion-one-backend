<?php

namespace App\Repositories\Eloquent\Customers;

use App\Models\GiftCard;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Customers\GiftCardRepositoryInterface;

class GiftCardRepository extends BaseRepository implements GiftCardRepositoryInterface
{
    protected function model(): string
    {
        return GiftCard::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}