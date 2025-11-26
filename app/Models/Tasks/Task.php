<?php

namespace App\Models\Tasks;

use App\enums\ActiveEnum;
use App\Enums\Tasks\TaskStatusEnum;
use App\Enums\Tasks\TaskTypeEnum;
use App\Models\Wallets\Wallet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'title',
        'duration',
        'amount',
        'reward',
        'active',
        'status',
        'type',
        'description',
        'score',
        'wallet_id',
    ];

    protected $casts = [
        'active' => ActiveEnum::class,
        'status' => TaskStatusEnum::class,
        'type' => TaskTypeEnum::class,
    ];

    /**
     * @return BelongsTo
     */
    public function wallet(): BelongsTo
    {
        return $this->belongsTo(Wallet::class);
    }
}
