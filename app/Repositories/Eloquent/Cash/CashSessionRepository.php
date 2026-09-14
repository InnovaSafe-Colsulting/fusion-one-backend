<?php

namespace App\Repositories\Eloquent\Cash;

use App\Models\CashSession;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Cash\CashSessionRepositoryInterface;

class CashSessionRepository extends BaseRepository implements CashSessionRepositoryInterface
{
    protected function model(): string
    {
        return CashSession::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}