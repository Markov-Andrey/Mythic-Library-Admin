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
        Schema::table('dnd_characters', function (Blueprint $table) {
            $table->unsignedBigInteger('race_id')->after('gender_id')->nullable();
            $table->foreign('race_id')->references('id')->on('dnd_races');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dnd_characters', function (Blueprint $table) {
            $table->dropForeign(['race_id']);
            $table->dropColumn('race_id');
        });
    }
};
