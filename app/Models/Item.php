<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

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
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
    public function getImageAttribute($value)
    {
        return $value ? asset("storage/items/{$value}") : null;
    }
}
