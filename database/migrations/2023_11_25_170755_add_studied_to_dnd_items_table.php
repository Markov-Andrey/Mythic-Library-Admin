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
        Schema::table('dnd_items', function (Blueprint $table) {
            $table->boolean('studied')->after('weight')->comment('Изучено')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dnd_items', function (Blueprint $table) {
            $table->dropColumn('studied');
        });
    }
};
