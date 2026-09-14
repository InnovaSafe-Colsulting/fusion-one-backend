<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComboItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['combo_id', 'product_id', 'quantity'];

    protected $casts = ['quantity' => 'decimal:4'];
}
