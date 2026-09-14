<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tenant_id', 'branch_id', 'name', 'capacity', 'status',
        'position_x', 'position_y', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'integer',
    ];
}
