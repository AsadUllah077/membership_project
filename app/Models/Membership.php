<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'ifmp_id',
        'name',
        'cnic',
        'status',
        'dues',
        'balance',
        'm_date',
        'valid_till',
    ];


    public function certificates(){
        return $this->hasMany(Certificate::class,'member_id');
    }

}
