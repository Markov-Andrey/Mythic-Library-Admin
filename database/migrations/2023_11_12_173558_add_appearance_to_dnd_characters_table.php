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
            $table->text('description')->nullable()->change();
            $table->text('appearance')->after('description')->nullable();
            $table->string('languages')->after('appearance')->nullable();
            $table->string('traits')->after('languages')->nullable();
            $table->string('ideals')->after('traits')->nullable();
            $table->string('attachment')->after('ideals')->nullable();
            $table->string('weakness')->after('attachment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dnd_characters', function (Blueprint $table) {
            $table->dropColumn('appearance');
            $table->dropColumn('languages');
            $table->dropColumn('traits');
            $table->dropColumn('ideals');
            $table->dropColumn('attachment');
            $table->dropColumn('weakness');
        });
    }
};
