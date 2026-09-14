<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'tenant_id', 'document_type', 'document_number', 'first_name',
        'last_name', 'email', 'phone', 'birth_date', 'notes', 'is_active',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_active'  => 'integer',
    ];
}
