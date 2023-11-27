<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassesSpellSlot extends Model
{
    use HasFactory;

    protected $table = 'dnd_classes_spell_slot';

    protected $fillable = [
        'known_conspiracies',
        'known_spells',
        'class_id',
        'character_level',
        'spell_slots_level_1',
        'spell_slots_level_2',
        'spell_slots_level_3',
        'spell_slots_level_4',
        'spell_slots_level_5',
        'spell_slots_level_6',
        'spell_slots_level_7',
        'spell_slots_level_8',
        'spell_slots_level_9',
    ];

    public $timestamps = false;

    /*
     * RELATION
     */
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
