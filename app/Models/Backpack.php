<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backpack extends Model
{
    use HasFactory;

    protected $table = 'dnd_characters_backpack';


    protected $fillable = [
        'character_id',
        'item_id',
        'quantity'
    ];

    /*
    * RELATION
    */
    public function character()
    {
        return $this->belongsTo(Character::class, 'character_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
