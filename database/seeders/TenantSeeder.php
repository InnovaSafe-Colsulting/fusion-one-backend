<?php

namespace Database\Seeders;

use App\Models\Tenats;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        Tenats::create([
            'name'            => 'FusionOne Demo',
            'commercial_name' => 'FusionOne Demo',
            'legal_name'      => 'FusionOne Demo S.A.S',
            'email'           => 'demo@fusionone.com',
            'phone'           => '3001234567',
            'address'         => 'Calle 1 # 2-3',
            'neighboarhood'   => 'Centro',
            'city_id'         => 1,
            'status'          => 1,
            'timezone'        => 'America/Bogota',
        ]);
    }
}
