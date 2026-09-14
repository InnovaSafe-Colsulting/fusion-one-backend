<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseType extends Model
{
    protected $fillable = ['tenant_id', 'name', 'slug', 'description', 'is_system', 'is_active'];

    protected $casts = [
        'is_system' => 'integer',
        'is_active' => 'integer',
    ];
}
