<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'tenant_id', 'branch_id', 'user_id', 'customer_id', 'table_id',
        'order_number', 'type', 'status', 'subtotal', 'discount',
        'tax', 'tip', 'total', 'notes', 'opened_at', 'closed_at',
    ];

    protected $casts = [
        'subtotal'   => 'decimal:2',
        'discount'   => 'decimal:2',
        'tax'        => 'decimal:2',
        'tip'        => 'decimal:2',
        'total'      => 'decimal:2',
        'opened_at'  => 'datetime',
        'closed_at'  => 'datetime',
    ];

    public function table()
    {
        return $this->belongsTo(RestaurantTable::class, 'table_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
