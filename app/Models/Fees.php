<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    protected $fillable = [
        'status',
        'amount',
        'fees_year',
        'cnic',
        'ifmp_id'
    ];
}
