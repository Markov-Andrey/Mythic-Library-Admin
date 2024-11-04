<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        'session_id',
        'parent_id',
        'name',
        'type',
        'description',
        'attributes',
    ];

    protected $casts = [
        'attributes' => 'array',
    ];

    public function parent()
    {
        return $this->belongsTo(Location::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
}