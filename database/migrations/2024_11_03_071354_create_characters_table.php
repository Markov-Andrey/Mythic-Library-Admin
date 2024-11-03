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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('avatar')->nullable();
            $table->string('name')->default('-');
            $table->integer('health')->default(0);
            $table->integer('max_health')->default(0);
            $table->json('attributes')->nullable();
            $table->integer('experience')->default(0);
            $table->string('info')->nullable();
            $table->boolean('is_npc')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('moonshine_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
