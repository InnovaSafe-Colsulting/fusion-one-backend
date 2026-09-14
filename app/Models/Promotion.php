<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public $timestamps = false;

    protected $fillable = ['tenant_id', 'name', 'description', 'type', 'value', 'starts_at', 'ends_at', 'is_active'];

    protected $casts = [
        'value'     => 'decimal:2',
        'starts_at' => 'datetime',
        'ends_at'   => 'datetime',
        'is_active' => 'boolean',
    ];
}
