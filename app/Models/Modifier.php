<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modifier extends Model
{
    use HasFactory;

    protected $table = 'dnd_modifier';

    protected $fillable = [
        'value',
        'modifier'
    ];

    public $timestamps = false;
}
