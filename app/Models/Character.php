<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = 'dnd_characters';

    protected $fillable = [
        'name',
        'logo',
        'class_id',
        'history',
        'experience',
        'level',
        'strength',
        'dexterity',
        'constitution',
        'intelligence',
        'wisdom',
        'charisma',
    ];

    /*
     * RELATION
     */
    public function Classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

}
