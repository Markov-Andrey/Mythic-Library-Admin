<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharactersSpell extends Model
{
    use HasFactory;

    protected $table = 'dnd_characters_spell';

    protected $fillable = [
        'character_id',
        'spell_id'
    ];

    public $timestamps = false;


    /*
     * RELATION
     */
    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
    public function spell()
    {
        return $this->belongsTo(Spell::class, 'spell_id');
    }
}
