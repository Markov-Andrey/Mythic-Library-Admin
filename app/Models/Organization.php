<?php

namespace App\Models;

use App\Traits\BelongsToSession;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use BelongsToSession;

    protected $table = 'organizations';

    protected $fillable = [
        'session_id',
        'logo_url',
        'name',
        'type',
        'description',
        'status',
        'parameters',
    ];

    protected $casts = [
        'parameters' => 'array',
    ];
}
