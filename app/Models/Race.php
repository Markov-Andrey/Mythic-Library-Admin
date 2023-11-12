<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    use HasFactory;

    protected $table = 'dnd_races';

    protected $fillable = [
        'title',
        'illustration',
        'description',
        'size_id',
        'speed'
    ];

    public $timestamps = false;

    /*
     * RELATION
     */
    public function size()
    {
        return $this->belongsTo(Dimensions::class, 'size_id');
    }
}
