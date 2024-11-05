<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'amount',
        'reciept_number',
        'reciept_date',
        'bank_name',
        'cnic',
        'ifmp_id'
    ];
}
