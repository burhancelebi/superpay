<?php

namespace App\DTO\Transactions;

use Illuminate\Http\UploadedFile;
use Spatie\LaravelData\Data;

class TransactionDTO extends Data
{
    public function __construct(
        public int $merchant_payment_system_id = 1,
        public int|null $user_id = null,
        public int|null $parent_id = null,
        public int $transaction_group_id,
        public int|null $customer_id = null,
        public string|null $reference_name = null,
        public float $requested_amount = 0,
        public int|null $installment = 1,
        public float $payment_system_rate = 0,
        public float|null $payment_system_fee_amount = 0.0,
        public float|null $balance = 0.0,
        public float|null $remaining_amount = 0.0,
        public float|null $our_rate = 0,
        public float|null $our_fee_amount = 0.0,
        public float|null $amount_sent = 0.0,
        public UploadedFile|null $withdrawal_receipt = null,
        public UploadedFile|null $payment_receipt = null,
        public int|null $status = null,
        public string|null $requested_at = null,
        public string|null $sent_at = null,
    ) {
        $this->user_id ??= auth()->id();
        $this->payment_system_fee_amount ??= 0.0;
        $this->balance ??= 0.0;
        $this->amount_sent ??= 0.0;
        $this->our_rate ??= 0.0;
        $this->our_fee_amount ??= 0.0;
        $this->remaining_amount ??= 0.0;
        $this->sent_at ??= now();
        $this->requested_at ??= now();
    }
}
