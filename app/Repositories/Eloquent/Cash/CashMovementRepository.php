<?php

namespace App\Repositories\Eloquent\Cash;

use App\Models\CashMovement;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Cash\CashMovementRepositoryInterface;

class CashMovementRepository extends BaseRepository implements CashMovementRepositoryInterface
{
    protected function model(): string
    {
        return CashMovement::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}