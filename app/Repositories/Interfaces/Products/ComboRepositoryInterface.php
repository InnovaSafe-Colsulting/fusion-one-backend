<?php

namespace App\Repositories\Interfaces\Products;

use App\Repositories\Interfaces\BaseRepositoryInterface;

interface ComboRepositoryInterface extends BaseRepositoryInterface
{
    public function allPaginated(array $filters = []): mixed;
    public function allActive(): array;
    public function findWithItems(int $id): mixed;
    public function updateStatus(int $id): mixed;
}
