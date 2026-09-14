<?php

namespace App\Repositories\Eloquent\Customers;

use App\Models\LoyaltyAccount;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Customers\LoyaltyAccountRepositoryInterface;

class LoyaltyAccountRepository extends BaseRepository implements LoyaltyAccountRepositoryInterface
{
    protected function model(): string
    {
        return LoyaltyAccount::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}