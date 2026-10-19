<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\PaymentMethod;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\PaymentMethodRepositoryInterface;

class PaymentMethodRepository extends BaseRepository implements PaymentMethodRepositoryInterface
{
    protected function model(): string
    {
        return PaymentMethod::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function updateStatus(int $id, bool $isActive): mixed
    {
        $method = $this->query()->findOrFail($id);
        $method->update(['is_active' => $isActive]);
        return $method->fresh();
    }

    public function allActive(): mixed
    {
        return $this->query()
            ->where('is_active', true)
            ->select('id', 'name', 'code', 'type')
            ->get();
    }

    public function findWithConfigs(int $id): mixed
    {
        return $this->query()
            ->with('configs')
            ->findOrFail($id);
    }
}