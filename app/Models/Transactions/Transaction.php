<?php

namespace App\Models\Transactions;

use App\Models\File;
use App\Models\Payments\MerchantPaymentSystem;
use App\Models\User;
use App\Observers\TransactionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([TransactionObserver::class])]
class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'merchant_payment_system_id',
        'user_id',
        'parent_id',
        'transaction_group_id',
        'reference_name',
        'requested_amount',
        'installment',
        'payment_system_rate',
        'payment_system_fee_amount',
        'balance',
        'remaining_amount',
        'our_rate',
        'our_fee_amount',
        'amount_sent',
        'status',
        'requested_at',
        'sent_at',
    ];

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(TransactionGroup::class, 'transaction_group_id');
    }

    /**
     * @return BelongsTo
     */
    public function merchantPayment(): BelongsTo
    {
        return $this->belongsTo(MerchantPaymentSystem::class, 'merchant_payment_system_id');
    }

    /**
     * @return HasMany
     */
    public function partialPayments(): HasMany
    {
        return $this->hasMany(TransactionPayment::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function subTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'parent_id');
    }

    /**
     * @return MorphMany
     */
    public function files(): MorphMany
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * @param Builder $query
     * @param $date
     * @return Builder
     */
    public function scopeRequestedAtBetween(Builder $query, $date): Builder
    {
        $dates = explode(' - ', $date);

        if (count($dates) === 2) {
            [$start, $end] = $dates;

            return $query->whereBetween('requested_at', [$start, $end]);
        }

        return $query->whereDate('requested_at', $date);
    }

    /**
     * @param Builder $query
     * @param $date
     * @return Builder
     */
    public function scopeSentAtBetween(Builder $query, $date): Builder
    {
        $dates = explode(' - ', $date);

        if (count($dates) === 2) {
            [$start, $end] = $dates;

            return $query->whereBetween('sent_at', [$start, $end]);
        }

        return $query->whereDate('sent_at', $date);
    }

    public function getTotalRequestedAmountAttribute(): float
    {
        $selfAmount = $this->requested_amount ?? 0;

        if (is_null($this->parent_id)) {
            $subsAmount = $this->subTransactions->sum('requested_amount');
            return $selfAmount + $subsAmount;
        }

        $siblingsAmount = $this->parent->subTransactions->sum('requested_amount');

        return $selfAmount + $siblingsAmount;
    }

    public function getTotalAmountSentAttribute(): float
    {
        if (!is_null($this->parent_id))
        {
            return $this->parent->partialPayments->sum('amount') + $this->parent->amount_sent;
        }

        if ($this->partialPayments->count() > 0) {
            return $this->partialPayments->sum('amount') + $this->amount_sent;
        }

        return $this->amount_sent;
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeAwaitingPayment(Builder $query): Builder
    {
        return $query->where(function ($q) {
            $q->where('amount_sent', 0)->orWhere('amount_sent', 0.0);
        })->whereNull('parent_id');
    }
}
