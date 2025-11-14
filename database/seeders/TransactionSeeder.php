<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = [
            // Property 1 - Apartment
            ['property_id' => 1, 'type' => 'income', 'amount' => 850.00, 'concept' => 'Alquiler mes octubre', 'date' => '2025-10-01'],
            ['property_id' => 1, 'type' => 'expense', 'amount' => 100.00, 'concept' => 'Reparación fontanería', 'date' => '2025-10-05'],
            ['property_id' => 1, 'type' => 'income', 'amount' => 850.00, 'concept' => 'Alquiler mes noviembre', 'date' => '2025-11-01'],

            // Property 2 - House (available)
            ['property_id' => 2, 'type' => 'expense', 'amount' => 200.00, 'concept' => 'Mantenimiento del terreno', 'date' => '2025-10-15'],

            // Property 3 - Local
            ['property_id' => 3, 'type' => 'income', 'amount' => 600.00, 'concept' => 'Alquiler mes octubre', 'date' => '2025-10-01'],
            ['property_id' => 3, 'type' => 'expense', 'amount' => 50.00, 'concept' => 'Limpieza profunda', 'date' => '2025-10-10'],
            ['property_id' => 3, 'type' => 'income', 'amount' => 600.00, 'concept' => 'Alquiler mes noviembre', 'date' => '2025-11-01'],

            // Property 4 - Apartment
            ['property_id' => 4, 'type' => 'income', 'amount' => 950.00, 'concept' => 'Alquiler mes octubre', 'date' => '2025-10-01'],
            ['property_id' => 4, 'type' => 'expense', 'amount' => 75.00, 'concept' => 'Reparación aire acondicionado', 'date' => '2025-10-12'],
            ['property_id' => 4, 'type' => 'income', 'amount' => 950.00, 'concept' => 'Alquiler mes noviembre', 'date' => '2025-11-01'],

            // Property 6 - House
            ['property_id' => 6, 'type' => 'income', 'amount' => 1100.00, 'concept' => 'Alquiler mes octubre', 'date' => '2025-10-01'],
            ['property_id' => 6, 'type' => 'expense', 'amount' => 150.00, 'concept' => 'Pintura fachada', 'date' => '2025-10-20'],
            ['property_id' => 6, 'type' => 'income', 'amount' => 1100.00, 'concept' => 'Alquiler mes noviembre', 'date' => '2025-11-01'],

            // Property 8 - Local
            ['property_id' => 8, 'type' => 'income', 'amount' => 400.00, 'concept' => 'Alquiler mes octubre', 'date' => '2025-10-01'],
            ['property_id' => 8, 'type' => 'income', 'amount' => 400.00, 'concept' => 'Alquiler mes noviembre', 'date' => '2025-11-01'],
        ];

        foreach ($transactions as $transaction) {
            \App\Models\Transaction::create($transaction);
        }
    }
}
