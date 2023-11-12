<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genders extends Model
{
    use HasFactory;

    protected $table = 'dnd_genders';

    protected $fillable = [
        'title'
    ];

    public $timestamps = false;
}
