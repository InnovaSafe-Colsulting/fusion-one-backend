<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentMethodConfig extends Model
{
    protected $fillable = ['tenant_id', 'payment_method_id', 'key', 'value', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
