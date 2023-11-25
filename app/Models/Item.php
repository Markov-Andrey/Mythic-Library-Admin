<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'dnd_items';

    protected $fillable = [
        'image',
        'title',
        'description',
        'value',
        'weight',
        'studied',
    ];

    /*
    * RELATION
    */
    public function types()
    {
        return $this->hasMany(ItemTypeItem::class, 'item_id');
    }
}
