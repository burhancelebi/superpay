<?php

namespace App\enums;

enum ActiveEnum: int
{
    case PASSIVE = 0;
    case ACTIVE = 1;

    /**
     * @return string
     */
    public function label(): string
    {
        return match($this) {
            self::ACTIVE => 'Aktif',
            self::PASSIVE  => 'Pasif',
        };
    }

    /**
     * @return self
     */
    public function toggle(): self
    {
        return match ($this) {
            self::ACTIVE => self::PASSIVE,
            self::PASSIVE => self::ACTIVE,
        };
    }
}
