<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusicRequest extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tenant_id', 'branch_id', 'customer_id', 'title', 'artist', 'status', 'requested_at',
    ];

    protected $casts = ['requested_at' => 'datetime'];
}
