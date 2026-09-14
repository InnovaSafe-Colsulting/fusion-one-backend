<?php

namespace App\Repositories\Eloquent\Staff;

use App\Models\Position;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Staff\PositionRepositoryInterface;

class PositionRepository extends BaseRepository implements PositionRepositoryInterface
{
    protected function model(): string
    {
        return Position::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}