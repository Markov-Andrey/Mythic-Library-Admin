<?php

namespace App\Models;

use App\Traits\BelongsToSession;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Игроки в сессии
 */
class SessionUser extends Pivot
{
    use BelongsToSession;

    protected $table = 'session_user';

    protected $fillable = [
        'session_id',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
