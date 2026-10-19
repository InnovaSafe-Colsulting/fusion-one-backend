<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public $timestamps = false;

    protected $table = 'inventory';

    protected $fillable = ['tenant_id', 'warehouse_id', 'product_id', 'quantity', 'reserved_quantity', 'reserved_at', 'average_cost', 'min_stock'];

    protected $casts = [
        'quantity'          => 'decimal:4',
        'reserved_quantity' => 'decimal:4',
        'reserved_at'       => 'datetime',
        'average_cost'      => 'decimal:4',
        'min_stock'         => 'decimal:4',
    ];
}
