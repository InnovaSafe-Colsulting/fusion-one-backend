<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            CoutriesSeeder::class,
            CitiesSeeder::class,
            TenantSeeder::class,
            BranchSeeder::class,
            ModulesSeeder::class,
            PermissionsSeeder::class,
            RolesSeeder::class,
            UsersSeeder::class,
            PaymentMethodSeeder::class,
            CurrencySeeder::class,
            ProductTypeSeeder::class,
            PriceListSeeder::class,
        ]);
    }
}
