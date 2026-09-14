<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeePosition extends Model
{
    public $timestamps = false;

    protected $fillable = ['employee_id', 'position_id'];
}
