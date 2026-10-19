<?php

namespace Database\Seeders;

use App\Enums\PriceListType;
use App\Models\PriceList;
use App\Models\Tenats;
use Illuminate\Database\Seeder;

class PriceListSeeder extends Seeder
{
    public function run(int $tenantId = 0): void
    {
        $tenantId = $tenantId ?: Tenats::first()?->id;

        if (!$tenantId) {
            $this->command->warn('No tenant found. Skipping PriceListSeeder.');
            return;
        }

        $lists = [
            ['name' => 'Lista mayorista',  'type' => PriceListType::CUSTOMER, 'description' => 'Precios para clientes mayoristas',       'is_default' => false],
            ['name' => 'Lista minorista',  'type' => PriceListType::CUSTOMER, 'description' => 'Precios para clientes minoristas',       'is_default' => true],
            ['name' => 'Lista domicilios', 'type' => PriceListType::CHANNEL,  'description' => 'Precios para pedidos a domicilio',       'is_default' => false],
            ['name' => 'Lista happy hour', 'type' => PriceListType::TIME,     'description' => 'Precios especiales en horario especial', 'is_default' => false],
        ];

        foreach ($lists as $list) {
            PriceList::firstOrCreate(
                ['tenant_id' => $tenantId, 'name' => $list['name']],
                ['type' => $list['type'], 'description' => $list['description'], 'is_default' => $list['is_default'], 'is_active' => true]
            );
        }
    }
}
