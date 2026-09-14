<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['tenant_id', 'product_id', 'version', 'yield_quantity', 'is_active'];

    protected $casts = [
        'yield_quantity' => 'decimal:4',
        'is_active'      => 'boolean',
    ];
}
