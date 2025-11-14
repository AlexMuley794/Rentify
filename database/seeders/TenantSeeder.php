<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            [
                'name' => 'Carlos González López',
                'phone' => '+34 612 345 678',
                'email' => 'carlos.gonzalez@example.com',
                'notes' => 'Cliente regular, paga a tiempo',
            ],
            [
                'name' => 'María Rodríguez García',
                'phone' => '+34 623 456 789',
                'email' => 'maria.rodriguez@example.com',
                'notes' => 'Família con dos niños',
            ],
            [
                'name' => 'Juan Martínez Pérez',
                'phone' => '+34 634 567 890',
                'email' => 'juan.martinez@example.com',
                'notes' => 'Profesional, contrato de 12 meses',
            ],
            [
                'name' => 'Ana Fernández López',
                'phone' => '+34 645 678 901',
                'email' => 'ana.fernandez@example.com',
                'notes' => 'Estudiante, alquiler de corta duración',
            ],
            [
                'name' => 'Pedro Sánchez Martín',
                'phone' => '+34 656 789 012',
                'email' => 'pedro.sanchez@example.com',
                'notes' => 'Inquilino nuevo',
            ],
        ];

        foreach ($tenants as $tenant) {
            \App\Models\Tenant::create($tenant);
        }
    }
}
