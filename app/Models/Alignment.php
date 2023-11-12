<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alignment extends Model
{
    use HasFactory;

    protected $table = 'dnd_alignments';

    protected $fillable = [
        'title',
        'description'
    ];

    public $timestamps = false;
}
