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
        Schema::table('properties', function (Blueprint $table) {
            if (!Schema::hasColumn('properties', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            }
            
            if (Schema::hasColumn('properties', 'name') && !Schema::hasColumn('properties', 'title')) {
                $table->renameColumn('name', 'title');
            }
        });

        Schema::table('properties', function (Blueprint $table) {
             if (Schema::hasColumn('properties', 'tenant_id')) {
                // Drop foreign key if it exists. 
                // Note: It's hard to check if FK exists easily in all drivers, 
                // but we can try-catch or just assume it exists if column exists and we know we added it.
                // For safety in this specific broken state, we'll try to drop it.
                try {
                    $table->dropForeign(['tenant_id']);
                } catch (\Exception $e) {
                    // Ignore if FK doesn't exist
                }
                $table->dropColumn('tenant_id');
            }

            if (Schema::hasColumn('properties', 'status')) {
                $table->dropColumn('status');
            }
        });
        
        Schema::table('tenants', function (Blueprint $table) {
            if (!Schema::hasColumn('tenants', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tenants', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            
            // Restore columns (simplified)
            $table->enum('status', ['available', 'occupied'])->default('available');
            $table->unsignedBigInteger('tenant_id')->nullable();
        });
    }
};
