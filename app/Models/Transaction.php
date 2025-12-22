<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

 

    protected $casts = [
        'occurred_on' => 'date'
    ];

    // fields the user can fill out. 
    protected $fillable = ['type', 'amount_cents', 'currency', 'category', 'occurred_on', 'note'];
}
