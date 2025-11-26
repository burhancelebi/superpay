<?php

namespace App\enums\Tasks;

enum TaskStatusEnum: int
{
    case OPEN = 1;
    case TAKEN = 2;

    public function label(): string
    {
        return match ($this) {
            self::OPEN => 'Açık',
            self::TAKEN => 'Alındı',
        };
    }
}
