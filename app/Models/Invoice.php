<?php

namespace App\Models;

use App\Enums\InvoiceStatus;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'tenant_id', 'branch_id', 'order_id', 'customer_id', 'invoice_number',
        'prefix', 'subtotal', 'discount', 'tax', 'tip', 'total', 'status', 'issued_at',
    ];

    protected $casts = [
        'subtotal'  => 'decimal:2',
        'discount'  => 'decimal:2',
        'tax'       => 'decimal:2',
        'tip'       => 'decimal:2',
        'total'     => 'decimal:2',
        'issued_at' => 'datetime',
        'status'    => InvoiceStatus::class,
    ];
}
