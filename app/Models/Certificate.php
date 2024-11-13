<?php

namespace App\Models;

use App\Models\Membership;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    protected $fillable = [
        'valid_till',
        'certification',
        'category',
        'member_id'

    ];

    public function member() :BelongsTo{
        return $this->belongsTo(Membership::class);
    }
}
