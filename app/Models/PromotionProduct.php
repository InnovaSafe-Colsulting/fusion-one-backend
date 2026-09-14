<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PromotionProduct extends Model
{
    public $timestamps = false;

    protected $fillable = ['promotion_id', 'product_id'];
}
