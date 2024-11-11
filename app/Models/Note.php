<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $appends = ['game_time_data'];

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

    /**
     * Аксессор для получения `game_time_data` как JSON-объекта.
     *
     * @return array
     */
    public function getGameTimeDataAttribute(): array
    {
        $parts = explode('.', $this->attributes['game_time'] ?? '0000000.00.00.00.00');

        return [
            'year' => (int) ($parts[0] ?? 0),
            'month' => (int) ($parts[1] ?? 0),
            'day' => (int) ($parts[2] ?? 0),
            'hour' => (int) ($parts[3] ?? 0),
            'minute' => (int) ($parts[4] ?? 0),
        ];
    }
}
