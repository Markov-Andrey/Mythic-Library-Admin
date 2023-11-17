<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dimensions extends Model
{
    use HasFactory;

    protected $table = 'dnd_dimensions';

    protected $fillable = [
        'title',
        'size',
        'space',
        'dice',
        'carrying',
        'pushing'
    ];

    public $timestamps = false;

    /*
     * RELATION
     */
    public function races()
    {
        return $this->hasMany(Race::class, 'size_id');
    }
}
