<?php

namespace App\Models;

use App\Enums\PriceListEntityType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class PriceListItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['price_list_id', 'entity_id', 'entity_type', 'price'];

    protected $casts = [
        'price'       => 'decimal:2',
        'entity_type' => PriceListEntityType::class,
    ];

    public function priceList(): BelongsTo
    {
        return $this->belongsTo(PriceList::class);
    }

    public function entity(): MorphTo
    {
        return $this->morphTo();
    }
}
