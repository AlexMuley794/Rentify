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
            $table->string('type')->after('address')->nullable(); // Nullable for existing records
            $table->decimal('price', 10, 2)->after('type')->default(0);
            $table->text('description')->after('price')->nullable();
            $table->string('image_path')->after('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn(['type', 'price', 'description', 'image_path']);
        });
    }
};
