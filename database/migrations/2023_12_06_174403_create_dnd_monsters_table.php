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
        Schema::create('dnd_monsters', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->integer('health_max')->nullable();
            $table->integer('armor_class')->nullable();
            $table->integer('speed')->nullable();

            $table->unsignedBigInteger('alignments_id')->nullable();
            $table->foreign('alignments_id')->references('id')->on('dnd_alignments');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->foreign('size_id')->references('id')->on('dnd_dimensions');


            $table->integer('charisma')->nullable();
            $table->integer('wisdom')->nullable();
            $table->integer('intelligence')->nullable();
            $table->integer('constitution')->nullable();
            $table->integer('dexterity')->nullable();
            $table->integer('strength')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dnd_monsters');
    }
};
