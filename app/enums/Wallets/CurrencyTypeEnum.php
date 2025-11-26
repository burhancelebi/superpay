<?php

namespace App\enums\Wallets;

enum CurrencyTypeEnum: string
{
    case USDT = 'USDT';
    case BTC = 'BTC';
    case ETH = 'ETH';
    case BNB = 'BNB';

    public function label(): string
    {
        return match ($this) {
            self::USDT => 'Tether (USDT)',
            self::BTC => 'Bitcoin (BTC)',
            self::ETH => 'Ethereum (ETH)',
            self::BNB => 'Binance Coin (BNB)',
        };
    }
}
