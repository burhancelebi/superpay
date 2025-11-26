<?php

namespace App\enums\Wallets;

enum NetworkTypeEnum: string
{
    case TRC20 = 'TRC20';
    case ERC20 = 'ERC20';
    case BEP20 = 'BEP20';
    case BITCOIN = 'BITCOIN';

    public function label(): string
    {
        return match ($this) {
            self::TRC20 => 'Tron (TRC20)',
            self::ERC20 => 'Ethereum (ERC20)',
            self::BEP20 => 'BNB Smart Chain (BEP20)',
            self::BITCOIN => 'Bitcoin Ağı',
        };
    }
}
