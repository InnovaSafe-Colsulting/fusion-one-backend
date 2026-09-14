<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['product_id', 'name', 'sku', 'price', 'cost', 'barcode', 'is_active'];

    protected $casts = [
        'price'     => 'decimal:2',
        'cost'      => 'decimal:2',
        'is_active' => 'boolean',
    ];
}
