<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserBank extends Model
{
    protected $fillable = [
        'user_id',
        'bank_name',
        'iban',
        'account_holder'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
