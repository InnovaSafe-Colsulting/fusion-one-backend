<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryAdjustment extends Model
{
    public $timestamps = false;

    protected $fillable = ['tenant_id', 'warehouse_id', 'user_id', 'reason', 'status', 'created_at'];

    protected $casts = ['created_at' => 'datetime'];
}
