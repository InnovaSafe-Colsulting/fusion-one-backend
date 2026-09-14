<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['purchase_order_id', 'product_id', 'quantity', 'unit_cost', 'tax', 'subtotal'];

    protected $casts = [
        'quantity'  => 'decimal:4',
        'unit_cost' => 'decimal:4',
        'tax'       => 'decimal:2',
        'subtotal'  => 'decimal:2',
    ];
}
