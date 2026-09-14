<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\Tax;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\TaxRepositoryInterface;

class TaxRepository extends BaseRepository implements TaxRepositoryInterface
{
    protected function model(): string
    {
        return Tax::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}