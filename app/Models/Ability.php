<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    protected $table = 'abilities';

    protected $fillable = [
        'image',
        'name',
        'description',
        'type',
        'parameters',
    ];

    protected $casts = [
        'parameters' => 'array',
    ];
}
