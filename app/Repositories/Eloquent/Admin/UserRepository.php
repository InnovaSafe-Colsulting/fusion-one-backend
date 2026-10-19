<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\User;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected function model(): string
    {
        return User::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }

    public function allWithRelations(): mixed
    {
        return $this->query()
            ->with(['roles:id,name,slug', 'city:id,name'])
            ->select('id', 'tenant_id', 'first_name', 'last_name', 'email', 'cellphone', 'city_id', 'is_active', 'last_login_at')
            ->get();
    }

    public function findWithRelations(int $id): mixed
    {
        return $this->query()
            ->with(['roles:id,name,slug', 'city:id,name'])
            ->select('id', 'tenant_id', 'first_name', 'last_name', 'email', 'cellphone', 'city_id', 'is_active', 'last_login_at')
            ->findOrFail($id);
    }

    public function updateStatus(int $id, bool $isActive): mixed
    {
        $user = $this->query()->findOrFail($id);
        $user->update(['is_active' => $isActive]);
        return $user->fresh();
    }
}