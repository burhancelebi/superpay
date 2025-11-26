<?php

namespace App\enums\Tasks;

enum TaskTypeEnum: int
{
    case INVESTMENT = 1;
    case WITHDRAWAL = 2;

    public function label(): string
    {
        return match ($this) {
            self::INVESTMENT => 'Yatırım',
            self::WITHDRAWAL => 'Çekim',
        };
    }
}
