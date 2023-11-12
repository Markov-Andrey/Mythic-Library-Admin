<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharactersSkill extends Model
{
    use HasFactory;

    protected $table = 'dnd_character_skill';

    protected $fillable = [
        'character_id',
        'skill_id'
    ];

    public $timestamps = false;

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
    public function skill()
    {
        return $this->belongsTo(Skills::class, 'skill_id');
    }
}
