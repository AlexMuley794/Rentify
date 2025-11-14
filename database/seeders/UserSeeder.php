<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = \App\Models\Role::where('name', 'admin')->first();
        $userRole = \App\Models\Role::where('name', 'user')->first();

        // Admin user
        \App\Models\User::create([
            'name' => 'Admin Usuario',
            'email' => 'admin@rentify.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
        ]);

        // Regular user
        \App\Models\User::create([
            'name' => 'Usuario Colaborador',
            'email' => 'user@rentify.com',
            'password' => bcrypt('password'),
            'role_id' => $userRole->id,
        ]);

        // Additional test users
        \App\Models\User::factory(5)->create([
            'role_id' => $userRole->id,
        ]);
    }
}
