<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('session_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('type'); // Тип предмета (оружие, броня, зелье и т.д.)
            $table->integer('weight_per_unit')->default(0); // Вес одной единицы предмета
            $table->integer('value')->default(0); // Условная ценность предмета
            $table->json('properties')->nullable(); // Свойства предмета
            $table->boolean('has_hidden_properties')->default(false); // Наличие скрытых свойств
            $table->timestamps();

            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
