<?php

namespace App\DTO;

use Spatie\LaravelData\Data;

class UserDTO extends Data
{
    public function __construct(
        public string|null $name = null,
        public string|null $surname = null,
        public string|null $phone = null,
        public int|null $age = null,
        public string|null $email = null,
        public ?string $password = null
    ) {
    }
}
