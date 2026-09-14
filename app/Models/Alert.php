<?php

namespace App\Models;

use App\Enums\AlertType;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tenant_id', 'branch_id', 'type', 'message', 'severity', 'resolved_at',
    ];

    protected $casts = [
        'type'        => AlertType::class,
        'resolved_at' => 'datetime',
        'created_at'  => 'datetime',
    ];
}
