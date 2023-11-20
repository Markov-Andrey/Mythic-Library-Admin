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
        Schema::create('dnd_items', function (Blueprint $table) {
            $table->id();
            $table->string('image')->comment('изображение')->nullable();
            $table->string('title')->comment('название')->nullable();
            $table->text('description')->comment('описание')->nullable();
            $table->decimal('value')->comment('зм')->nullable();
            $table->decimal('weight')->comment('фунты')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dnd_items');
    }
};
