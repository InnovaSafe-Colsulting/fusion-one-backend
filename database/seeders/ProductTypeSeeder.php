<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Producto Físico',  'slug' => 'producto-fisico',  'description' => 'Ítem tangible que maneja inventario.'],
            ['name' => 'Servicio',         'slug' => 'servicio',         'description' => 'Servicio sin inventario físico, ej: domicilio, instalación.'],
            ['name' => 'Combo',            'slug' => 'combo',            'description' => 'Agrupación de productos vendidos juntos, ej: menú del día.'],
            ['name' => 'Preparado',        'slug' => 'preparado',        'description' => 'Producto con receta e ingredientes, ej: pizza, hamburguesa.'],
            ['name' => 'Digital',          'slug' => 'digital',          'description' => 'Producto sin inventario físico, ej: gift card, voucher.'],
            ['name' => 'Modificador',      'slug' => 'modificador',      'description' => 'Complemento de otro producto, ej: salsa extra, topping.'],
            ['name' => 'Ingrediente',      'slug' => 'ingrediente',      'description' => 'Materia prima usada en recetas, no se vende directamente.'],
        ];

        foreach ($types as $type) {
            DB::table('product_types')->insertOrIgnore(array_merge($type, [
                'tenant_id' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
