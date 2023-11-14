<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'dnd_campaigns';

    protected $fillable = [
        'title',
        'description',
        'setting',
        'image'
    ];
    public function Characters()
    {
        return $this->hasMany(Character::class, 'campaign_id');
    }
}
