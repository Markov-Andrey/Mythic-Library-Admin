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
            $table->unsignedBigInteger('alignments_id')->after('race_id')->nullable();
            $table->foreign('alignments_id')->references('id')->on('dnd_alignments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dnd_characters', function (Blueprint $table) {
            $table->dropForeign(['alignments_id']);
            $table->dropColumn('alignments_id');
        });
    }
};
