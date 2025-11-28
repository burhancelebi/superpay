<?php

namespace App\DTO\Users;

use Spatie\LaravelData\Data;

class UserDTO extends Data
{
    public function __construct(
        public string|null $name = null,
        public string|null $surname = null,
        public string|null $phone = null,
        public string|null $profession = null,
        public int|null $age = null,
        public string|null $email = null,
        public ?string $password = null
    ) {
    }
}
