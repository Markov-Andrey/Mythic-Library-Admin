<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Игроки в сессии
 */
class SessionUser extends Pivot
{
    use HasFactory;

    protected $table = 'session_user';

    protected $fillable = [
        'session_id',
        'user_id',
    ];
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
