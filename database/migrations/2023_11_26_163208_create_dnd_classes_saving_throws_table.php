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
        Schema::create('dnd_classes_saving_throws', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('characteristic_id');

            $table->foreign('class_id')
                ->references('id')
                ->on('dnd_classes')
                ->onDelete('cascade');

            $table->foreign('characteristic_id')
                ->references('id')
                ->on('dnd_characteristics')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dnd_classes_saving_throws');
    }
};
