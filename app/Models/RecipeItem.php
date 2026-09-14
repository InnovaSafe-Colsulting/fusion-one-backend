<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeItem extends Model
{
    public $timestamps = false;

    protected $fillable = ['recipe_id', 'ingredient_id', 'quantity', 'unit'];

    protected $casts = ['quantity' => 'decimal:4'];
}
