<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharactersExperience extends Model
{
    use HasFactory;

    protected $table = 'dnd_characters_experience';

    protected $fillable = [
        'character_id',
        'quantity',
        'reason'
    ];

    public function Characters()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}
