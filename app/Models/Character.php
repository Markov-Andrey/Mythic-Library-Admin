<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $table = 'dnd_characters';

    protected $fillable = [
        'name',
        'logo',
        'class_id',

        'description',
        'appearance',
        'languages',

        'traits',
        'ideals',
        'attachment',
        'weakness',

        'strength',
        'dexterity',
        'constitution',
        'intelligence',
        'wisdom',
        'charisma',
    ];

    /*
     * RELATION
     */
    public function Classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function Genders()
    {
        return $this->belongsTo(Genders::class, 'gender_id');
    }
    public function Races()
    {
        return $this->belongsTo(Race::class, 'race_id');
    }
    public function Alignment()
    {
        return $this->belongsTo(Alignment::class, 'alignments_id');
    }

}
