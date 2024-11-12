<?php

namespace App\Models;

use App\Traits\BelongsToSession;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use BelongsToSession;

    protected $table = 'items';

    protected $fillable = [
        'session_id',
        'name',
        'description',
        'image',
        'type',
        'weight_per_unit',
        'value',
        'properties',
        'has_hidden_properties',
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset("storage/items/{$this->image}") : null;
    }

    public function getWeightPerUnitAttribute($value): float|int
    {
        return $value / 100;
    }
    public function setWeightPerUnitAttribute($value): void
    {
        $this->attributes['weight_per_unit'] = $value * 100;
    }
    public function getValueAttribute($value): float|int
    {
        return $value / 100;
    }
    public function setValueAttribute($value): void
    {
        $this->attributes['value'] = $value * 100;
    }
    public function getFullImagePathAttribute(): ?string
    {
        return $this->image ? asset("storage/items/{$this->image}") : null;
    }
}
