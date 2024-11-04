<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id'); // Привязка к сессии
            $table->unsignedBigInteger('parent_id')->nullable(); // ID родительского объекта
            $table->string('name'); // Название объекта
            $table->string('type'); // Тип объекта (страна, город, здание и т.д.)
            $table->text('description')->nullable(); // Описание объекта
            $table->json('attributes')->nullable(); // Дополнительные характеристики объекта
            $table->timestamps();

            $table->foreign('session_id')
                ->references('id')
                ->on('sessions')
                ->onDelete('cascade');

            $table->foreign('parent_id')
                ->references('id')
                ->on('locations')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
