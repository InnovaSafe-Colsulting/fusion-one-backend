<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseReceipt extends Model
{
    public $timestamps = false;

    protected $fillable = ['tenant_id', 'purchase_order_id', 'warehouse_id', 'user_id', 'received_at', 'status'];

    protected $casts = ['received_at' => 'datetime'];
}
