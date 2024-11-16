<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'amount',
        'reciept_number',
        'reciept_date',
        'bank_name',
        'membership_id'
    ];

    public function member() :BelongsTo{
        return $this->belongsTo(Membership::class,'membership_id');
    }
}
