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
        Schema::create('dnd_races', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('illustration');
            $table->text('description');
            $table->unsignedBigInteger('size_id');
            $table->foreign('size_id')->references('id')->on('dnd_dimensions')->onDelete('cascade');
            $table->integer('speed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dnd_races');
    }
};
