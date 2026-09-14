<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\NumberingSequence;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\NumberingSequenceRepositoryInterface;

class NumberingSequenceRepository extends BaseRepository implements NumberingSequenceRepositoryInterface
{
    protected function model(): string
    {
        return NumberingSequence::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}