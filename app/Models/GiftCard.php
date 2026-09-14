<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    public $timestamps = false;

    protected $fillable = ['tenant_id', 'code', 'initial_balance', 'current_balance', 'expires_at', 'status'];

    protected $casts = [
        'initial_balance' => 'decimal:2',
        'current_balance' => 'decimal:2',
        'expires_at'      => 'date',
    ];
}
