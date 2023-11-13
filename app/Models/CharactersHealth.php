<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharactersHealth extends Model
{
    use HasFactory;

    protected $table = 'dnd_characters_health';

    protected $fillable = [
        'character_id',
        'quantity',
        'reason'
    ];

    /*
    * RELATION
    */
    public function Characters()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
}
