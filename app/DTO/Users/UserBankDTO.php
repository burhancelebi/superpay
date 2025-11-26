<?php

namespace App\DTO\Users;

use Spatie\LaravelData\Data;

class UserBankDTO extends Data
{
    public function __construct(
        public int $user_id,
        public string|null $bank_name = null,
        public string|null $iban = null,
    ) {
    }
}
