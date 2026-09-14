<?php

namespace App\Repositories\Eloquent\Staff;

use App\Models\Shift;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Staff\ShiftRepositoryInterface;

class ShiftRepository extends BaseRepository implements ShiftRepositoryInterface
{
    protected function model(): string
    {
        return Shift::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}