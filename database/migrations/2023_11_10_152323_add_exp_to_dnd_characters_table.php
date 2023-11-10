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
            $table->unsignedInteger('experience')->default(0)->after('history');
            $table->unsignedInteger('level')->default(1)->after('experience');
            $table->renameColumn('history', 'description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dnd_characters', function (Blueprint $table) {
            $table->renameColumn('description', 'history')->nullable();
            $table->dropColumn('experience');
            $table->dropColumn('level');
        });
    }
};
