<?php

namespace App\Repositories\Eloquent\Purchases;

use App\Models\Supplier;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Purchases\SupplierRepositoryInterface;

class SupplierRepository extends BaseRepository implements SupplierRepositoryInterface
{
    protected function model(): string
    {
        return Supplier::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}