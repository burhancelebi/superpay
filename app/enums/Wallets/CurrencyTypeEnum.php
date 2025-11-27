<?php

namespace App\enums\Wallets;

enum CurrencyTypeEnum: string
{
    case TRY = 'TRY';
    case USD = 'USD';
    case EUR = 'EUR';
    case USDT = 'USDT';
    case BTC = 'BTC';
    case ETH = 'ETH';
    case BNB = 'BNB';

    public function label(): string
    {
        return match ($this) {
            self::TRY => 'Türk Lirası (TRY)',
            self::USD => 'Amerikan Doları (USD)',
            self::EUR => 'Euro (EUR)',
            self::USDT => 'Tether (USDT)',
            self::BTC => 'Bitcoin (BTC)',
            self::ETH => 'Ethereum (ETH)',
            self::BNB => 'Binance Coin (BNB)',
        };
    }
}
