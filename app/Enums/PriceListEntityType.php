<?php

namespace App\Enums;

enum PriceListEntityType: string
{
    case PRODUCT  = 'product';
    case CUSTOMER = 'customer';
    case CHANNEL  = 'channel';
    case TABLE    = 'table';
    case TIME     = 'time';
    case EVENT    = 'event';

    public function toModelClass(): string
    {
        return match($this) {
            self::PRODUCT  => \App\Models\Product::class,
            self::CUSTOMER => \App\Models\Customer::class,
            self::CHANNEL  => 'App\Models\Channel',
            self::TABLE    => \App\Models\RestaurantTable::class,
            self::TIME     => 'App\Models\TimeSlot',
            self::EVENT    => 'App\Models\Event',
        };
    }
}
