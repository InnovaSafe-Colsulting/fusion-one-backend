<?php

namespace App\Repositories\Interfaces\Admin;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface CurrencyRepositoryInterface extends BaseRepositoryInterface
{
    public function updateStatus(int $id): mixed;
    public function setDefault(int $id): mixed;
    public function types(): mixed;
}
