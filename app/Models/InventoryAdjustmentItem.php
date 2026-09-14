<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryAdjustmentItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['adjustment_id', 'product_id', 'previous_quantity', 'new_quantity', 'difference'];

    protected $casts = [
        'previous_quantity' => 'decimal:4',
        'new_quantity'      => 'decimal:4',
        'difference'        => 'decimal:4',
    ];
}
