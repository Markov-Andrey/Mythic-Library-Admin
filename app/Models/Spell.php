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
        'level_requirement',
        'class_id'
    ];

    /*
     * RELATION
     */
    public function charactersSkills()
    {
        return $this->hasMany(CharactersSpell::class, 'spell_id');
    }
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
