<?php

namespace App\Models;

use App\Enums\KitchenOrderStatus;
use Illuminate\Database\Eloquent\Model;

class KitchenOrder extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tenant_id', 'branch_id', 'order_id', 'status', 'priority',
        'received_at', 'started_at', 'ready_at', 'delivered_at',
    ];

    protected $casts = [
        'status'       => KitchenOrderStatus::class,
        'received_at'  => 'datetime',
        'started_at'   => 'datetime',
        'ready_at'     => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
