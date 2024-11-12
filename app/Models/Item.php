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

    public function getWeightPerUnitAttribute($value)
    {
        return $value / 100;
    }
    public function setWeightPerUnitAttribute($value)
    {
        $this->attributes['weight_per_unit'] = $value * 100;
    }
    public function getValueAttribute($value)
    {
        return $value / 100;
    }
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = $value * 100;
    }
    public function getFullImagePathAttribute()
    {
        return $this->image ? asset("storage/items/{$this->image}") : null;
    }
}
