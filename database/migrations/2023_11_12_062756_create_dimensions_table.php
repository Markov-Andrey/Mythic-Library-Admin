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
        Schema::create('dnd_dimensions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('size');
            $table->string('space');
            $table->string('dice')->comment('Monster');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dnd_dimensions');
    }
};
