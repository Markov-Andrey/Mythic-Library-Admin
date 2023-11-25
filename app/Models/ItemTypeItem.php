<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTypeItem extends Model
{
    use HasFactory;

    protected $table = 'dnd_item_type_item';

    protected $fillable = [
        'item_id',
        'item_type_id',
    ];

    /*
     * RELATION
     */
    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function itemType()
    {
        return $this->belongsTo(ItemType::class, 'item_type_id');
    }
}
