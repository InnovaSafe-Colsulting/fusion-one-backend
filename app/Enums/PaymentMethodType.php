<?php

namespace App\Enums;

enum PaymentMethodType: string
{
    case CASH           = 'cash';
    case CARD           = 'card';
    case TRANSFER       = 'transfer';
    case DIGITAL_WALLET = 'digital_wallet';
    case GIFT_CARD      = 'gift_card';
    case CREDIT         = 'credit';

    public function label(): string
    {
        return match($this) {
            self::CASH           => 'Efectivo',
            self::CARD           => 'Tarjeta',
            self::TRANSFER       => 'Transferencia',
            self::DIGITAL_WALLET => 'Billetera Digital',
            self::GIFT_CARD      => 'Tarjeta Regalo',
            self::CREDIT         => 'Crédito',
        };
    }
}
