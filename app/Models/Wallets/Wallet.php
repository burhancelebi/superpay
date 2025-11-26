<?php

namespace App\Models\Wallets;

use App\enums\ActiveEnum;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'network',
        'currency',
        'address',
        'active',
    ];

    protected $casts = [
        'active' => ActiveEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
