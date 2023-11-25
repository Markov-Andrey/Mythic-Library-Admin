<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spell extends Model
{
    use HasFactory;

    protected $table = 'dnd_spells';

    protected $fillable = [
        'image',
        'title',
        'description',
        'level',
    ];

    /*
     * RELATION
     */
    public function charactersSkills()
    {
        return $this->hasMany(CharactersSpell::class, 'spell_id');
    }
}
