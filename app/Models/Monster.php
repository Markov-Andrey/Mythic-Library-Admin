<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Monster extends Model
{
    use HasFactory;

    protected $table = 'dnd_monsters';

    protected $fillable = [
        'name',
        'image',
        'description',
        'health_max',
        'armor_class',
        'speed',
        'alignments_id',
        'size_id',
    ];

    public $timestamps = false;

    /*
     * RELATION
     */
    public function alignment()
    {
        return $this->belongsTo(Alignment::class, 'alignments_id');
    }

    public function size()
    {
        return $this->belongsTo(Dimensions::class, 'size_id');
    }

    public function creature()
    {
        return $this->morphOne(CharacterCharacteristic::class, 'creature');
    }
}

