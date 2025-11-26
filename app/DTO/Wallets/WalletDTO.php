<?php

namespace App\DTO\Wallets;

use App\DTO\DtoHelper;
use App\enums\ActiveEnum;
use Spatie\LaravelData\Data;

class WalletDTO extends Data
{
    use DtoHelper;

    public function __construct(
        public int|null $user_id = null,
        public string|null $network = null,
        public string|null $currency = null,
        public string|null $address = null,
        public int $active = ActiveEnum::ACTIVE->value
    ) {}
}
