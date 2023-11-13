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
        Schema::create('dnd_characters_health', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('character_id');
            $table->integer('quantity');
            $table->string('reason')->nullable();
            $table->timestamps();

            $table->foreign('character_id')->references('id')->on('dnd_characters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dnd_characters_health');
    }
};
