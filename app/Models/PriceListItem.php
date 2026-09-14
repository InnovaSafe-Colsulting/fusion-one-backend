<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriceListItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['price_list_id', 'product_id', 'price'];

    protected $casts = ['price' => 'decimal:2'];
}
