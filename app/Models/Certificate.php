<?php

namespace App\Models;

use App\Models\Membership;
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

    public function membership()
    {
        return $this->hasMany(Membership::class, 'certificate_id');
    }
}
