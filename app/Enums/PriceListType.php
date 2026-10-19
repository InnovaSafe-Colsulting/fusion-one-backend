<?php

namespace App\Enums;

enum PriceListType: string
{
    case PRODUCT  = 'product';
    case CUSTOMER = 'customer';
    case CHANNEL  = 'channel';
    case TABLE    = 'table';
    case TIME     = 'time';
    case EVENT    = 'event';
}
