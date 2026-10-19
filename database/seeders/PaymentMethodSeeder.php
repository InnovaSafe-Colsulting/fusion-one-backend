<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $tenantId = 1;

        $methods = [
            ['name' => 'Efectivo',          'code' => 'CASH',           'type' => 'cash',           'is_active' => 1],
            ['name' => 'Tarjeta',           'code' => 'CARD',           'type' => 'card',           'is_active' => 1],
            ['name' => 'Transferencia',     'code' => 'TRANSFER',       'type' => 'transfer',       'is_active' => 1],
            ['name' => 'Billetera Digital', 'code' => 'DIGITAL_WALLET', 'type' => 'digital_wallet', 'is_active' => 1],
            ['name' => 'Tarjeta Regalo',    'code' => 'GIFT_CARD',      'type' => 'gift_card',      'is_active' => 1],
            ['name' => 'Crédito',           'code' => 'CREDIT',         'type' => 'credit',         'is_active' => 1],
        ];

        foreach ($methods as $method) {
            DB::table('payment_methods')->insertOrIgnore(array_merge($method, ['tenant_id' => $tenantId]));
        }
    }
}
