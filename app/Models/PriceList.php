<?php

namespace App\Models;

use App\Enums\PriceListType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PriceList extends Model
{
    public $timestamps = false;

    protected $fillable = ['tenant_id', 'name', 'type', 'description', 'is_default', 'is_active'];

    protected $casts = [
        'type'       => PriceListType::class,
        'is_default' => 'boolean',
        'is_active'  => 'boolean',
    ];


    public function items(): HasMany
    {
        return $this->hasMany(PriceListItem::class);
    }
}
