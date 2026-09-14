<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tenant_id', 'branch_id', 'customer_id', 'table_id',
        'reservation_number', 'reservation_date', 'guests', 'status', 'notes',
    ];

    protected $casts = ['reservation_date' => 'datetime'];
}
