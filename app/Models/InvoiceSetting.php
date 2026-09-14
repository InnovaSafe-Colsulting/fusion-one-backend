<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceSetting extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'logo', 'header', 'footer_invoice', 'message_description',
        'terms_conditions', 'show_taxes', 'show_tips', 'show_conpany_info',
    ];

    protected $casts = [
        'show_taxes'       => 'boolean',
        'show_tips'        => 'boolean',
        'show_conpany_info'=> 'boolean',
    ];
}
