<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\Currency;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\CurrencyRepositoryInterface;

class CurrencyRepository extends BaseRepository implements CurrencyRepositoryInterface
{
    protected function model(): string
    {
        return Currency::class;
    }

    protected function usesTenant(): bool
    {
        return false;
    }

    public function updateStatus(int $id): mixed
    {
        $record = $this->findById($id);
        $record->update(['is_active' => !$record->is_active]);
        return $record->fresh();
    }

    public function setDefault(int $id): mixed
    {
        Currency::query()->update(['selected' => 0]);
        $record = $this->findById($id);
        $record->update(['selected' => 1]);
        return $record->fresh();
    }

    public function types(): mixed
    {
        return Currency::query()->select('id', 'name', 'code')->where('is_active', 1)->get();
    }
}
