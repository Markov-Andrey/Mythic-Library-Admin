<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $table = 'characters';
    protected $fillable = [
        'user_id',
        'session_id',
        'avatar',
        'name',
        'health',
        'max_health',
        'attributes',
        'experience',
        'info',
        'is_npc',
    ];

    protected $casts = [
        'attributes' => 'array',
        'is_npc' => 'boolean',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function session(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
    public function inventory(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Inventory::class, 'character_id');
    }
    public function abilities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CharacterAbility::class, 'character_id');
    }
}
