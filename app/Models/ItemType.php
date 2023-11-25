<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    use HasFactory;

    protected $table = 'dnd_item_types';

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    /*
     * RELATION
     */
    public function items()
    {
        return $this->hasMany(ItemTypeItem::class, 'item_type_id');
    }
}
