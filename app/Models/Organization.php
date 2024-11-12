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
        'logo',
        'images',
        'name',
        'type',
        'description',
        'status',
        'parameters',
    ];

    protected $casts = [
        'parameters' => 'array',
        'images' => 'array',
    ];

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset("storage/organization_logo/{$this->logo}") : null;
    }
    public function getImagesUrlsAttribute(): array
    {
        return array_map(
            fn($image) => asset("storage/organization_images/{$image}"),
            $this->images ?? []
        );
    }
}
