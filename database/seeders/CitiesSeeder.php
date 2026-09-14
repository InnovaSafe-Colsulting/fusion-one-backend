<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cities;
use App\Models\Coutries;

class CitiesSeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            'Colombia'       => ['Bogotá', 'Medellín', 'Cali', 'Barranquilla', 'Cartagena'],
            'México'         => ['Ciudad de México', 'Guadalajara', 'Monterrey', 'Puebla', 'Tijuana'],
            'Argentina'      => ['Buenos Aires', 'Córdoba', 'Rosario', 'Mendoza', 'La Plata'],
            'Brasil'         => ['São Paulo', 'Río de Janeiro', 'Brasilia', 'Salvador', 'Fortaleza'],
            'Chile'          => ['Santiago', 'Valparaíso', 'Concepción', 'La Serena', 'Antofagasta'],
            'Perú'           => ['Lima', 'Arequipa', 'Trujillo', 'Chiclayo', 'Cusco'],
            'Ecuador'        => ['Quito', 'Guayaquil', 'Cuenca', 'Ambato', 'Manta'],
            'Venezuela'      => ['Caracas', 'Maracaibo', 'Valencia', 'Barquisimeto', 'Maracay'],
            'España'         => ['Madrid', 'Barcelona', 'Valencia', 'Sevilla', 'Zaragoza'],
            'Estados Unidos' => ['Nueva York', 'Los Ángeles', 'Chicago', 'Houston', 'Miami'],
        ];

        foreach ($cities as $countryName => $cityList) {
            $country = Coutries::where('name', $countryName)->first();
            if (!$country) continue;

            foreach ($cityList as $city) {
                Cities::create(['name' => $city, 'country_id' => $country->id, 'status' => 1]);
            }
        }
    }
}
