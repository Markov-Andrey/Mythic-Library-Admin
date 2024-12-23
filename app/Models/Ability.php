<?php

namespace App\Models;

use App\Traits\BelongsToSession;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use BelongsToSession;

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
    public function getFullImagePathAttribute()
    {
        return $this->image ? asset("storage/abilities/{$this->image}") : null;
    }
}
