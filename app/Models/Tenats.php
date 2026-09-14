<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenats extends Model
{
    protected $table = "tenants";
    protected $fillable = ['name', 'commercial_name','legal_name','email', 'phone', 'address', 'neighboarhood', 'city_id', 'logo', 'status', 'timezone']; 
    protected $casts = ['status' => 'integer'];
}
