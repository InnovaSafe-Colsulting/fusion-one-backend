<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tenant_id', 'user_id', 'branch_id', 'document_type', 'document_number',
        'first_name', 'last_name', 'phone', 'email', 'hire_date', 'status',
    ];

    protected $casts = ['hire_date' => 'date'];
}
