<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    protected $table = 'cities';
    protected $fillable = ['name', 'country_id', 'status'];
    protected $casts = ['status' => 'integer'];
}
