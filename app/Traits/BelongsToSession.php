<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Session;

trait BelongsToSession
{
    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }
}
