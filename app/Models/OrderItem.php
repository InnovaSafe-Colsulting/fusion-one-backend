<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'order_id', 'product_id', 'product_variant_id', 'quantity',
        'unit_price', 'discount', 'tax', 'subtotal', 'notes', 'status',
    ];

    protected $casts = [
        'quantity'   => 'decimal:4',
        'unit_price' => 'decimal:2',
        'discount'   => 'decimal:2',
        'tax'        => 'decimal:2',
        'subtotal'   => 'decimal:2',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
