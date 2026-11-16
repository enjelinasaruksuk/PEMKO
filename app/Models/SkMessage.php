<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkMessage extends Model
{
    protected $fillable = [
        'sk_id',
        'sender_role',
        'sender_name',
        'message',
    ];

    public function sk(): BelongsTo
    {
        return $this->belongsTo(Sk::class);
    }
}
