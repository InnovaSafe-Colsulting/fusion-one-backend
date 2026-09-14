<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public $timestamps = false;

    protected $fillable = ['tenant_id', 'warehouse_id', 'product_id', 'quantity', 'reserved_quantity', 'average_cost'];

    protected $casts = [
        'quantity'          => 'decimal:4',
        'reserved_quantity' => 'decimal:4',
        'average_cost'      => 'decimal:4',
    ];
}
