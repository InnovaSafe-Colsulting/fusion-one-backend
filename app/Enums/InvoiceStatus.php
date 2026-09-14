<?php

namespace App\Enums;

enum InvoiceStatus: string
{
    case PENDING = 'pending';
    case PAID    = 'paid';
    case CANCEL  = 'cancel';
    case ANULATE = 'anulate';

    public function label(): string
    {
        return match($this) {
            self::PENDING => 'Pendiente',
            self::PAID    => 'Pagada',
            self::CANCEL  => 'Cancelada',
            self::ANULATE => 'Anulada',
        };
    }
}
