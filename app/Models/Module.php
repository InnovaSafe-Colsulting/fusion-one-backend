<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'parent_id',
        'sub_parent_id',
        'sub_identifier',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function children()
    {
        return $this->hasMany(Module::class, 'parent_id')->with('children');
    }
}
