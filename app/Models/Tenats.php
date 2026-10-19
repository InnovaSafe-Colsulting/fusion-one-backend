<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Tenats extends Model
{
    protected $table = "tenants";
    protected $fillable = ['name', 'commercial_name','legal_name','email', 'phone', 'address', 'neighboarhood', 'city_id', 'logo', 'status', 'timezone'];
    protected $casts = ['status' => 'integer'];

    public function getLogoAttribute(?string $value): ?string
    {
        return $value ? Storage::disk('public')->url($value) : null;
    }
}
