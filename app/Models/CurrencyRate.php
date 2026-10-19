<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurrencyRate extends Model
{
    protected $fillable = ['currency_id', 'rate', 'value_from_currency', 'value_to_currency', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'rate'      => 'decimal:6',
    ];

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
