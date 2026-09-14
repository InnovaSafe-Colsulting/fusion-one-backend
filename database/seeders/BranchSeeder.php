<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('branches')->insert([
            'tenant_id'  => 1,
            'name'       => 'Sede Principal',
            'code'       => 'SEDE-01',
            'address'    => 'Calle 1 # 2-3',
            'phone'      => '3001234567',
            'email'      => 'sede.principal@fusionone.com',
            'city_id'    => 1,
            'is_active'  => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
