<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItemModifier extends Model
{
    public $timestamps = false;

    protected $fillable = ['order_item_id', 'modifier_option_id', 'quantity', 'price'];

    protected $casts = [
        'quantity' => 'decimal:4',
        'price'    => 'decimal:2',
    ];
}
