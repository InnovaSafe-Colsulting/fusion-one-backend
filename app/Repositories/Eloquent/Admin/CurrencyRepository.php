<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\Currency;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\CurrencyRepositoryInterface;

class CurrencyRepository extends BaseRepository implements CurrencyRepositoryInterface
{
    protected function model(): string
    {
        return Currency::class;
    }

    protected function usesTenant(): bool
    {
        return false;
    }
}