<?php

namespace App\Models;

use App\Traits\BelongsToSession;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use BelongsToSession;

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
    public function inventory(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Inventory::class, 'character_id');
    }
    public function abilities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CharacterAbility::class, 'character_id');
    }
    /**
     * Связь с Inventory и Item, объединяя их данные.
     */
    public function inventoryWithItems()
    {
        return $this->hasManyThrough(Item::class, Inventory::class, 'character_id', 'id', 'id', 'item_id')
            ->select('items.*', 'inventory.quantity', 'inventory.add_properties');
    }
    /**
     * Связь с Ability через CharacterAbility, объединяя их данные.
     */
    public function abilitiesWithDetails()
    {
        return $this->hasManyThrough(Ability::class, CharacterAbility::class, 'character_id', 'id', 'id', 'ability_id')
            ->select('abilities.*', 'character_abilities.add_properties');
    }
}
