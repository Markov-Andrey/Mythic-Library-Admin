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
        Schema::table('dnd_spells', function (Blueprint $table) {
            $table->integer('level_requirement')->after('level')->nullable();
            $table->unsignedBigInteger('class_id')->after('level_requirement')->nullable();
            $table->foreign('class_id')->references('id')->on('dnd_classes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dnd_spells', function (Blueprint $table) {
            $table->dropColumn('level_requirement');
            $table->dropForeign(['class_id']);
            $table->dropColumn('class_id');
        });
    }
};
