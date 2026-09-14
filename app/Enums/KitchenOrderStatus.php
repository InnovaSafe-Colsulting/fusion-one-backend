<?php

namespace App\Enums;

enum KitchenOrderStatus: string
{
    case PENDING   = 'pending';
    case PREPARING = 'preparing';
    case READY     = 'ready';
    case DELIVERED = 'delivered';

    public function label(): string
    {
        return match($this) {
            self::PENDING   => 'Pendiente',
            self::PREPARING => 'En preparación',
            self::READY     => 'Listo',
            self::DELIVERED => 'Entregado',
        };
    }
}
