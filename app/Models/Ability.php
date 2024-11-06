<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    protected $table = 'abilities';

    protected $fillable = [
        'session_id',
        'image',
        'name',
        'description',
        'type',
        'parameters',
    ];

    protected $casts = [
        'parameters' => 'array',
    ];
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
    public function getFullImagePathAttribute()
    {
        return $this->image ? asset("storage/abilities/{$this->image}") : null;
    }
}
