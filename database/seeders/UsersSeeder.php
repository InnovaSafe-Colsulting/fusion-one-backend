<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = \App\Models\Tenats::where('email', 'demo@fusionone.com')->first();

        $user = User::create([
            'tenant_id'  => $tenant?->id,
            'first_name' => 'Wilmar David',
            'last_name'  => 'Macias Guerrero',
            'email'      => 'admin@fusionone.com',
            'password'   => Hash::make('Admin1234!'),
            'cellphone'  => null,
            'city_id'    => 1,
            'is_active'  => true,
        ]);

        $role = Role::where('slug', 'super-admin')->first();

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id,
        ]);
    }
}
