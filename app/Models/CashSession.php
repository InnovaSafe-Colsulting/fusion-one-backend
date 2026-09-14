<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashSession extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tenant_id', 'branch_id', 'cash_register_id', 'user_id',
        'opening_amount', 'expected_amount', 'actual_amount', 'difference',
        'opened_at', 'closed_at', 'status',
    ];

    protected $casts = [
        'opening_amount'  => 'decimal:2',
        'expected_amount' => 'decimal:2',
        'actual_amount'   => 'decimal:2',
        'difference'      => 'decimal:2',
        'opened_at'       => 'datetime',
        'closed_at'       => 'datetime',
    ];

    public function cashRegister()
    {
        return $this->belongsTo(CashRegister::class);
    }

    public function movements()
    {
        return $this->hasMany(CashMovement::class, 'cash_session_id');
    }
}
