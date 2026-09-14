<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NumberingSequence extends Model
{
    protected $fillable = [
        'tenant_id', 'branch_id', 'document_type', 'prefix',
        'resolution_number', 'start_number', 'end_number', 'current_number', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
