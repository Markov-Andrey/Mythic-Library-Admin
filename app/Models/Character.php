<?php

namespace App\Models;

use App\Models\Character\Info;
use App\Models\Character\ShortInfo;
use Illuminate\Database\Eloquent\Model;
use stdClass;

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

        'health_current',
        'health_max',
        'exp',

        'strength',
        'dexterity',
        'constitution',
        'intelligence',
        'wisdom',
        'charisma',

        'campaign_id',
    ];

    /*
     * RELATION
     */
    public function classes()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
    public function genders()
    {
        return $this->belongsTo(Genders::class, 'gender_id');
    }
    public function races()
    {
        return $this->belongsTo(Race::class, 'race_id');
    }
    public function alignment()
    {
        return $this->belongsTo(Alignment::class, 'alignments_id');
    }
    public function characterExperience()
    {
        return $this->hasMany(CharactersExperience::class, 'character_id');
    }
    public function characterSkills()
    {
        return $this->hasMany(CharactersSkill::class, 'character_id');
    }
    public function campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
    public function backpack()
    {
        return $this->hasMany(Backpack::class, 'character_id');
    }

    /*
     * FUNCTIONS
     */
    public static function CharacterInfo($id): stdClass
    {
        return Info::Info($id);
    }
    public static function CharacterShortInfo(): array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
    {
        return ShortInfo::Info();
    }

}
