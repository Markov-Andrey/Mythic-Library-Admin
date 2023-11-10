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
        Schema::table('dnd_characters', function (Blueprint $table) {
            $table->tinyInteger('athletics')->comment('Атлетика');
            $table->tinyInteger('acrobatics')->comment('Акробатика');
            $table->tinyInteger('sleight_of_hand')->comment('Ловкость рук');
            $table->tinyInteger('stealth')->comment('Скрытность');
            $table->tinyInteger('arcana')->comment('Магия');
            $table->tinyInteger('history')->comment('История');
            $table->tinyInteger('investigation')->comment('Расследование');
            $table->tinyInteger('nature')->comment('Природа');
            $table->tinyInteger('religion')->comment('Религия');
            $table->tinyInteger('animal_handling')->comment('Обращение с животными');
            $table->tinyInteger('insight')->comment('Проницательность');
            $table->tinyInteger('medicine')->comment('Медицина');
            $table->tinyInteger('perception')->comment('Восприятие');
            $table->tinyInteger('survival')->comment('Выживание');
            $table->tinyInteger('deception')->comment('Обман');
            $table->tinyInteger('intimidation')->comment('Запугивание');
            $table->tinyInteger('performance')->comment('Выступление');
            $table->tinyInteger('persuasion')->comment('Убеждение');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dnd_characters', function (Blueprint $table) {
            $table->dropColumn('athletics');
            $table->dropColumn('acrobatics');
            $table->dropColumn('sleight_of_hand');
            $table->dropColumn('stealth');
            $table->dropColumn('arcana');
            $table->dropColumn('history');
            $table->dropColumn('investigation');
            $table->dropColumn('nature');
            $table->dropColumn('religion');
            $table->dropColumn('animal_handling');
            $table->dropColumn('insight');
            $table->dropColumn('medicine');
            $table->dropColumn('perception');
            $table->dropColumn('survival');
            $table->dropColumn('deception');
            $table->dropColumn('intimidation');
            $table->dropColumn('performance');
            $table->dropColumn('persuasion');
        });
    }
};
