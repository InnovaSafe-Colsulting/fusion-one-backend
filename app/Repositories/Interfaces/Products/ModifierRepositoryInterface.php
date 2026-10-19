<?php

namespace App\Repositories\Interfaces\Products;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface ModifierRepositoryInterface extends BaseRepositoryInterface
{
    public function allPaginated(array $filters = []): mixed;
    public function findWithOptions(int $id): mixed;
    public function updateStatus(int $id): mixed;
}
