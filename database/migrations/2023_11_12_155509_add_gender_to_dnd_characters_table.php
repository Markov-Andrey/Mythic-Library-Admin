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
            $table->unsignedBigInteger('gender_id')->after('name')->nullable();
            $table->foreign('gender_id')->references('id')->on('dnd_genders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dnd_characters', function (Blueprint $table) {
            $table->dropForeign(['gender_id']);
            $table->dropColumn('gender_id');
        });
    }
};
