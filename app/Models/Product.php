<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'tenant_id', 'category_id', 'name', 'sku', 'barcode',
        'description', 'type_product_id', 'cost', 'price', 'is_active',
    ];

    protected $casts = [
        'cost'      => 'decimal:2',
        'price'     => 'decimal:2',
        'is_active' => 'boolean',
    ];
}
