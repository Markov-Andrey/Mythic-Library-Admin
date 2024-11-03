<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Characters extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar',
        'name',
        'health',
        'max_health',
        'attributes',
        'experience',
        'info',
        'is_npc',
    ];

    protected $casts = [
        'attributes' => 'array',
        'is_npc' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
