<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Сессия и админ сессии
 */
class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'preview',
        'user_id',
        'name',
        'description',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function sessionUsers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SessionUser::class);
    }
    public function getPreviewUrlAttribute(): string
    {
        return asset("storage/sessions/{$this->preview}");
    }
}
