<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Membership extends Model
{
    protected $fillable = [
        'ifmp_id',
        'name',
        'cnic',
        'company_id',
        'phone',
        'mobile',
        'm_date',
        'email',
        'sba'
    ];


    public function certificates()
    {
        return $this->hasMany(Certificate::class, 'member_id');
    }

    public function fees()
    {
        return $this->hasOne(Fees::class, 'member_id');
    }


    public function payments()
    {
        return $this->hasMany(Payment   ::class);
    }
}
