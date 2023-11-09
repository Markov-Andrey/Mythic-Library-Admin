<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'dnd_experience';

    protected $fillable = [
        'points',
        'level',
        'mastery_bonus',
    ];
}
