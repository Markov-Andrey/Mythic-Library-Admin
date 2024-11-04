<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';

    protected $fillable = [
        'character_id',
        'item_id',
        'quantity',
        'add_properties',
    ];

    protected $casts = [
        'add_properties' => 'array',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
