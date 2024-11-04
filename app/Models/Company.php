<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'total_paid',
        'total_dues',
        't_inactive',
        't_active'

    ];
}
