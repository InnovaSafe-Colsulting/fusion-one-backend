<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable = ['tenant_id', 'branch_id', 'name', 'code', 'warehouse_type_id', 'is_active'];

    protected $casts = [
        'is_active' => 'integer',
    ];
}
