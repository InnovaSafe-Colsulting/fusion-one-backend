<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantFiscalData extends Model
{
    protected $fillable = [
        'tenant_id',
        'tax_id',
        'verification_digit',
        'tax_regime',
        'fiscal_address',
    ];
}
