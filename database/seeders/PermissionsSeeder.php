<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            [
                'action'      => 'create',
                'name'        => 'Crear',
                'description' => 'Permite crear nuevos registros en el sistema',
                'is_active'   => 1,
            ],
            [
                'action'      => 'update',
                'name'        => 'Editar Simple',
                'description' => 'Permite editar un registro individual',
                'is_active'   => 1,
            ],
            [
                'action'      => 'bulk_update',
                'name'        => 'Editar Múltiple',
                'description' => 'Permite editar varios registros al mismo tiempo',
                'is_active'   => 1,
            ],
            [
                'action'      => 'delete',
                'name'        => 'Borrar Simple',
                'description' => 'Permite eliminar un registro individual',
                'is_active'   => 1,
            ],
            [
                'action'      => 'bulk_delete',
                'name'        => 'Borrar Múltiple',
                'description' => 'Permite eliminar varios registros al mismo tiempo',
                'is_active'   => 1,
            ],
            [
                'action'      => 'list',
                'name'        => 'Listar',
                'description' => 'Permite ver el listado de registros',
                'is_active'   => 1,
            ],
            [
                'action'      => 'view',
                'name'        => 'Ver',
                'description' => 'Permite ver el detalle de un registro individual',
                'is_active'   => 1,
            ],
        ];

        DB::table('permissions')->insertOrIgnore($permissions);
    }
}
