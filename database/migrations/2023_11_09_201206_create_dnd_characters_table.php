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
        Schema::create('dnd_characters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->text('history')->nullable();
            $table->tinyInteger('strength')->unsigned()->default(0);
            $table->tinyInteger('dexterity')->unsigned()->default(0);
            $table->tinyInteger('constitution')->unsigned()->default(0);
            $table->tinyInteger('intelligence')->unsigned()->default(0);
            $table->tinyInteger('wisdom')->unsigned()->default(0);
            $table->tinyInteger('charisma')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dnd_characters');
    }
};
