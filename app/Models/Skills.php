<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;

    protected $table = 'dnd_skills';

    protected $fillable = [
        'code',
        'title',
        'characteristics_id'
    ];

    public $timestamps = false;

    /*
     * RELATION
     */
    public function characteristics()
    {
        return $this->belongsTo(Characteristics::class, 'characteristics_id');
    }
    public function charactersSkills()
    {
        return $this->hasMany(CharactersSkill::class, 'skill_id');
    }
}
