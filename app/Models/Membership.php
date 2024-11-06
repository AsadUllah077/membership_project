<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'ifmp_id',
        'name',
        'cnic',
        'certificate_id',
        'status',
        'dues',
        'balance',
        'm_date',
        'valid_till',
    ];

    public function certificate()
    {
        return $this->belongsTo(Certificate::class, 'certificate_id');
    }
}
