<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        $currencies = [
            ['code' => 'USD', 'name' => 'Dólar Estadounidense', 'symbol' => '$',  'decimal_places' => 2, 'is_active' => true],
            ['code' => 'EUR', 'name' => 'Euro',                  'symbol' => '€',  'decimal_places' => 2, 'is_active' => true],
            ['code' => 'GBP', 'name' => 'Libra Esterlina',       'symbol' => '£',  'decimal_places' => 2, 'is_active' => true],
            ['code' => 'COP', 'name' => 'Peso Colombiano',       'symbol' => '$',  'decimal_places' => 2, 'is_active' => true],
            ['code' => 'MXN', 'name' => 'Peso Mexicano',         'symbol' => '$',  'decimal_places' => 2, 'is_active' => true],
            ['code' => 'ARS', 'name' => 'Peso Argentino',        'symbol' => '$',  'decimal_places' => 2, 'is_active' => true],
            ['code' => 'BRL', 'name' => 'Real Brasileño',        'symbol' => 'R$', 'decimal_places' => 2, 'is_active' => true],
            ['code' => 'CLP', 'name' => 'Peso Chileno',          'symbol' => '$',  'decimal_places' => 0, 'is_active' => true],
            ['code' => 'PEN', 'name' => 'Sol Peruano',           'symbol' => 'S/', 'decimal_places' => 2, 'is_active' => true],
            ['code' => 'CRC', 'name' => 'Colón Costarricense',   'symbol' => '₡',  'decimal_places' => 2, 'is_active' => true],
        ];

        DB::table('currencies')->insertOrIgnore($currencies);
    }
}
