<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashRegister extends Model
{
    public $timestamps = false;

    protected $fillable = ['tenant_id', 'branch_id', 'name', 'code', 'is_active'];

    protected $casts = [
        'is_active' => 'integer',
    ];
}
