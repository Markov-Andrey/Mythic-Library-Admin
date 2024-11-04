<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterAbility extends Model
{
    use HasFactory;

    protected $table = 'character_abilities';

    protected $fillable = [
        'character_id',
        'ability_id',
        'add_properties',
    ];

    protected $casts = [
        'add_properties' => 'array',
    ];

    public function character(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
    public function ability(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Ability::class, 'ability_id');
    }
}
