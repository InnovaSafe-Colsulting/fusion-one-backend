<?php

namespace App\Repositories\Eloquent\Products;

use App\Models\Modifier;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Products\ModifierRepositoryInterface;

class ModifierRepository extends BaseRepository implements ModifierRepositoryInterface
{
    protected function model(): string
    {
        return Modifier::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}