<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'valid_till',
        'certification',
        'category',
        'cnic',
        'ifmp_id'

    ];
}
