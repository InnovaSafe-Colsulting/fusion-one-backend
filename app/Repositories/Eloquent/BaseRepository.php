<?php

namespace App\Repositories\Eloquent;

use App\Context\TenantContext;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;
    protected TenantContext $tenantContext;

    public function __construct(TenantContext $tenantContext)
    {
        $this->tenantContext = $tenantContext;
        $this->model = app($this->model());
    }

    abstract protected function model(): string;

    protected function query()
    {
        $query = $this->model->newQuery();

        if ($this->tenantContext->hasTenant() && $this->usesTenant()) {
            $query->where('tenant_id', $this->tenantContext->getTenantId());
        }

        return $query;
    }

    protected function getTenantId(): ?int
    {
        return $this->tenantContext->hasTenant() ? $this->tenantContext->getTenantId() : null;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function all(array $filters = []): mixed
    {
        return $this->query()->get();
    }

    public function findById(int $id): mixed
    {
        return $this->query()->findOrFail($id);
    }

    public function create(array $data): mixed
    {
        if ($this->tenantContext->hasTenant() && $this->usesTenant()) {
            $data['tenant_id'] = $this->tenantContext->getTenantId();
        }

        return $this->model->create($data);
    }

    public function update(int $id, array $data): mixed
    {
        $record = $this->findById($id);
        $record->update($data);
        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        return $this->findById($id)->delete();
    }
}
