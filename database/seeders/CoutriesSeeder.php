<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coutries;

class CoutriesSeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            'Colombia', 'México', 'Argentina', 'Brasil', 'Chile',
            'Perú', 'Ecuador', 'Venezuela', 'España', 'Estados Unidos',
        ];

        foreach ($countries as $name) {
            Coutries::create(['name' => $name, 'status' => 1]);
        }
    }
}
