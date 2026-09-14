<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Combo;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\ComboRepositoryInterface;

class ComboRepository extends BaseRepository implements ComboRepositoryInterface
{
    protected function model(): string
    {
        return Combo::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}