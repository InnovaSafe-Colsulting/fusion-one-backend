<?php

namespace App\Repositories\Eloquent\Cash;

use App\Models\CashRegister;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Cash\CashRegisterRepositoryInterface;

class CashRegisterRepository extends BaseRepository implements CashRegisterRepositoryInterface
{
    protected function model(): string
    {
        return CashRegister::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}