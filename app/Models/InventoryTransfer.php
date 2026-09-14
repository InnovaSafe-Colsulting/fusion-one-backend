<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransfer extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tenant_id', 'from_warehouse_id', 'to_warehouse_id', 'user_id',
        'status', 'notes', 'transferred_at',
    ];

    protected $casts = [
        'transferred_at' => 'datetime',
    ];
}
