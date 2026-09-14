<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyTransaction extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tenant_id', 'customer_id', 'type', 'points',
        'reference_type', 'reference_id', 'created_at',
    ];

    protected $casts = ['created_at' => 'datetime'];
}
