<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Currency extends Model
{
    public $timestamps = false;

    protected $fillable = ['code', 'name', 'symbol', 'decimal_places', 'is_active', 'selected'];

    protected $casts = [
        'is_active' => 'boolean',
        'selected'  => 'boolean',
    ];

    public function rates(): HasMany
    {
        return $this->hasMany(CurrencyRate::class);
    }
}
