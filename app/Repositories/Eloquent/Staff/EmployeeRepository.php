<?php

namespace App\Repositories\Eloquent\Staff;

use App\Models\Employee;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Staff\EmployeeRepositoryInterface;

class EmployeeRepository extends BaseRepository implements EmployeeRepositoryInterface
{
    protected function model(): string
    {
        return Employee::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}