<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryOrder extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tenant_id', 'branch_id', 'order_id', 'customer_id', 'driver_id',
        'address', 'latitude', 'longitude', 'status', 'delivery_fee', 'delivered_at',
    ];

    protected $casts = [
        'delivery_fee' => 'decimal:2',
        'delivered_at' => 'datetime',
    ];
}
