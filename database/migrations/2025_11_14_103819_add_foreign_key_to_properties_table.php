<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Asegurarse de que ambas tablas existen antes de agregar la foreign key
        if (Schema::hasTable('tenants') && Schema::hasTable('properties')) {
            try {
                Schema::table('properties', function (Blueprint $table) {
                    $table->foreign('tenant_id')
                          ->references('id')
                          ->on('tenants')
                          ->onDelete('set null');
                });
            } catch (\Exception $e) {
                // Si la foreign key ya existe, ignorar el error
                // Esto puede ocurrir si la migración se ejecuta múltiples veces
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['tenant_id']);
        });
    }
};
