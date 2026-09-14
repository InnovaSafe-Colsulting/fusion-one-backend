<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransferItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['transfer_id', 'product_id', 'quantity'];

    protected $casts = ['quantity' => 'decimal:4'];
}
