<?php

namespace App\Models;

use App\Enums\PaymentMethodType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    protected $fillable = ['tenant_id', 'name', 'code', 'type', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'type'      => PaymentMethodType::class,
    ];

    public function configs(): HasMany
    {
        return $this->hasMany(PaymentMethodConfig::class);
    }
}
