<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fees extends Model
{
    protected $fillable = [
        'status',
        'fees_date',
        'receipt_date',
        'fees',
        'amount',
        'fees_year',
        'member_id'
    ];
    public function member(): BelongsTo
    {
        return $this->belongsTo(Membership::class, "member_id");
    }
}
