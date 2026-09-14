<?php

namespace App\Repositories\Eloquent\Customers;

use App\Models\Customer;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Customers\CustomerRepositoryInterface;

class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
{
    protected function model(): string
    {
        return Customer::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}