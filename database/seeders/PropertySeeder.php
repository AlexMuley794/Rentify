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

        foreach ($properties as $data) {
            $status = $data['status'];
            $tenantId = $data['tenant_id'];
            
            unset($data['status']);
            unset($data['tenant_id']);
            
            // Ensure user_id is set (assuming user 1 exists from UserSeeder)
            $data['user_id'] = 1; 

            $property = \App\Models\Property::create($data);

            if ($status === 'occupied' && $tenantId) {
                \App\Models\Reservation::create([
                    'property_id' => $property->id,
                    'tenant_id' => $tenantId,
                    'start_date' => now()->subDays(5),
                    'end_date' => now()->addDays(25),
                    'total_price' => $property->price,
                ]);
            }
        }
    }
}
