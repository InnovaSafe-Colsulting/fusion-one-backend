<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tenant_id', 'warehouse_id', 'product_id', 'user_id', 'type',
        'quantity', 'unit_cost', 'reference_type', 'reference_id', 'notes', 'created_at',
    ];

    protected $casts = [
        'quantity'   => 'decimal:4',
        'unit_cost'  => 'decimal:4',
        'created_at' => 'datetime',
    ];
}
