<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dnd_characters', function (Blueprint $table) {
            $table->boolean('inspiration')->after('charisma')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dnd_characters', function (Blueprint $table) {
            $table->dropColumn('inspiration');
        });
    }
};
