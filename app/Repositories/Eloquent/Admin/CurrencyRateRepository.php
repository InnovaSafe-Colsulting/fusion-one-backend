<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\CurrencyRate;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\CurrencyRateRepositoryInterface;

class CurrencyRateRepository extends BaseRepository implements CurrencyRateRepositoryInterface
{
    protected function model(): string
    {
        return CurrencyRate::class;
    }

    protected function usesTenant(): bool
    {
        return false;
    }
}
