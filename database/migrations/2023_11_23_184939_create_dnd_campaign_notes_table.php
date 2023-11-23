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
        Schema::create('dnd_campaign_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('campaign_id');
            $table->string('title');
            $table->text('tags')->nullable();
            $table->text('description')->nullable();
            $table->boolean('personal_note')->default(false);
            $table->timestamps();

            // Foreign key relationships
            $table->foreign('campaign_id')->references('id')->on('dnd_campaigns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dnd_campaign_notes');
    }
};
