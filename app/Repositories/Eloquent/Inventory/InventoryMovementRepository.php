<?php

namespace App\Repositories\Eloquent\Inventory;

use App\Models\InventoryMovement;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Inventory\InventoryMovementRepositoryInterface;

class InventoryMovementRepository extends BaseRepository implements InventoryMovementRepositoryInterface
{
    protected function model(): string
    {
        return InventoryMovement::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function updateByReferenceId(int $inventoryId, array $data): int
    {
        return $this->query()
            ->where('reference_id', $inventoryId)
            ->update($data);
    }
}
