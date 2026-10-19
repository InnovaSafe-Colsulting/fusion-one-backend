<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Modifier extends Model
{
    public $timestamps = false;

    protected $fillable = ['tenant_id', 'name', 'selection_type', 'min_selection', 'max_selection', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function options(): HasMany
    {
        return $this->hasMany(ModifierOption::class);
    }
}
