<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $fillable = [
        'title',
        'content',
        'type',
        'session_id',
        'access_users',
        'game_time',
    ];

    protected $casts = [
        'type' => 'array',
        'access_users' => 'array',
    ];

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
