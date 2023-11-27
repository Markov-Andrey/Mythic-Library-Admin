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
        Schema::create('dnd_classes_spell_slot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->integer('character_level')->nullable();

            $table->integer('known_conspiracies')->nullable();
            $table->integer('known_spells')->nullable();
            for ($i = 1; $i <= 9; $i++) {
                $table->integer("spell_slots_level_$i")->nullable();
            }

            $table->foreign('class_id')->references('id')->on('dnd_classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dnd_classes_spell_slot');
    }
};
