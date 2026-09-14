<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'tenant_id', 'document_type', 'document_number', 'name',
        'email', 'phone', 'address', 'is_active',
    ];

    protected $casts = ['is_active' => 'integer'];
}
