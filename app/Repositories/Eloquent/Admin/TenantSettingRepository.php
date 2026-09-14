<?php

namespace App\Repositories\Eloquent\Admin;

use App\Models\TenantSetting;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\Admin\TenantSettingRepositoryInterface;

class TenantSettingRepository extends BaseRepository implements TenantSettingRepositoryInterface
{
    protected function model(): string
    {
        return TenantSetting::class;
    }

    protected function usesTenant(): bool
    {
        return true;
    }
}