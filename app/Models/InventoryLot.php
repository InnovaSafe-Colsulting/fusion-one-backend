<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLot extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tenant_id', 'warehouse_id', 'product_id', 'lot_number',
        'quantity', 'expiration_date', 'unit_cost',
    ];

    protected $casts = [
        'quantity'        => 'decimal:4',
        'unit_cost'       => 'decimal:4',
        'expiration_date' => 'date',
    ];
}
