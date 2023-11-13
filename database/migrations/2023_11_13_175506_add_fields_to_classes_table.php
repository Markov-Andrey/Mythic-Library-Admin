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
        Schema::table('dnd_classes', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name');
            $table->integer('health_bonus')->default(0);
            $table->integer('basic_health')->default(0);
            $table->integer('health_per_level')->default(0);
            $table->integer('alternative_health_per_level')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dnd_classes', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'health_bonus',
                'basic_health',
                'health_per_level',
                'alternative_health_per_level'
            ]);
        });
    }
};
