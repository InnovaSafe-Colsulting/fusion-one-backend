<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['tenant_id', 'category_id', 'name', 'sku', 'unit', 'cost', 'is_active'];

    protected $casts = [
        'cost'      => 'decimal:4',
        'is_active' => 'boolean',
    ];
}
