<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coutries extends Model
{
    protected $table = 'coutries';
    protected $fillable = ['name', 'status'];
    protected $casts = ['status' => 'integer'];
}
