<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            [
                'name' => 'Apartamento céntrico 2 habitaciones',
                'address' => 'Calle Principal 123, Madrid',
                'status' => 'occupied',
                'tenant_id' => 1,
            ],
            [
                'name' => 'Casa rural con terreno',
                'address' => 'Carretera Nacional 5, Toledo',
                'status' => 'available',
                'tenant_id' => null,
            ],
            [
                'name' => 'Local comercial en zona de tránsito',
                'address' => 'Avenida Comercial 45, Barcelona',
                'status' => 'occupied',
                'tenant_id' => 2,
            ],
            [
                'name' => 'Apartamento moderno con piscina',
                'address' => 'Calle del Mar 78, Valencia',
                'status' => 'occupied',
                'tenant_id' => 3,
            ],
            [
                'name' => 'Estudio compacto y práctico',
                'address' => 'Plaza Central 12, Sevilla',
                'status' => 'available',
                'tenant_id' => null,
            ],
            [
                'name' => 'Casa adosada con jardín',
                'address' => 'Calle Tranquila 34, Bilbao',
                'status' => 'occupied',
                'tenant_id' => 4,
            ],
            [
                'name' => 'Apartamento con vistas al mar',
                'address' => 'Paseo Marítimo 56, Málaga',
                'status' => 'available',
                'tenant_id' => null,
            ],
            [
                'name' => 'Local pequeño para oficina',
                'address' => 'Calle de Negocios 9, Zaragoza',
                'status' => 'occupied',
                'tenant_id' => 5,
            ],
        ];

        foreach ($properties as $property) {
            \App\Models\Property::create($property);
        }
    }
}
