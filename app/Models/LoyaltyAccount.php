<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyAccount extends Model
{
    protected $fillable = ['tenant_id', 'customer_id', 'points_balance'];
}
