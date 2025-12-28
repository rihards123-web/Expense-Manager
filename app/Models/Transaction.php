<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{

    // This transaction has a user_id. To get its user, find the row in users where users.id = transactions.user_id
    // So for a transaction with user_id = 7, Laravel runs:
    // SELECT * FROM users WHERE id = 7 LIMIT 1
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'occurred_on' => 'date'
    ];

    // fields the user can fill out. 
    protected $fillable = ['type', 'amount_cents', 'currency', 'category', 'occurred_on', 'note'];
}
