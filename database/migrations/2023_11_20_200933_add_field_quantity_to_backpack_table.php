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
        Schema::table('dnd_characters_backpack', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->comment('количество');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dnd_characters_backpack', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};
