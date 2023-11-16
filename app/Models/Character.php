<?php

namespace App\Models;

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

        'health_max',

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

    /*
     * FUNCTIONS
     */
    public static function CharacterInfo($id)
    {
        $query = Character::with([
            'Classes:id,name,icon,health_bonus,basic_health,health_per_level,alternative_health_per_level',
            'Genders:id,title',
            'Races:id,title',
            'Alignment:id,title',
            'CharacterExperience',
            'CharacterSkills',
            'Campaign'
        ])
        ->find($id);

        $character = new stdClass();
        $character->info = (object)[
            'id' => $query->id,
            'name' => $query->name,
            'logo' => $query->logo,
            'gender' => $query->genders->title,
            'race' => $query->races->title,
            'alignment' => $query->races->alignment,
        ];
        $character->class = (object)[
            'name' => $query->classes->name,
            'icon' => $query->classes->icon,
            'health_bonus' => $query->classes->health_bonus,
            'basic_health' => $query->classes->basic_health,
            'health_per_level' => $query->classes->health_per_level,
            'alternative_health_per_level' => $query->classes->alternative_health_per_level,
        ];
        $character->desription = (object)[
            'description' => $query->description,
            'appearance' => $query->appearance,
            'languages' => $query->languages,
            'ideals' => $query->ideals,
            'attachment' => $query->attachment,
            'weakness' => $query->weakness
        ];
        $character->health = (object)[
            'health_max' => $query->health_max,
        ];
        $character->basic_params = (object)[
            'strength' => $query->strength,
            'dexterity' => $query->dexterity,
            'constitution' => $query->constitution,
            'intelligence' => $query->intelligence,
            'wisdom' => $query->wisdom,
            'charisma' => $query->charisma,
        ];
        $character->basic_modifier = (object)[];

        foreach ($character->basic_params as $key => $value) {
            $character->basic_modifier->$key = Modifier::Calculate($value);
        }

        $dndSkills = Skills::all();
        $dndCharacteristics = Characteristics::all();

        $skillsArray = array_fill_keys($dndSkills->pluck('code')->toArray(), 0);

        foreach ($dndSkills as $skill) {
            $characteristicCode = $dndCharacteristics->find($skill->characteristics_id)->code;
            $modifierValue = $character->basic_params->$characteristicCode;
            $modifier = Modifier::Calculate($modifierValue);
            $skillsArray[$skill->code] += $modifier;
        }
        $character->skills_modifier = (object) $skillsArray;

        $characterExperience = CharactersExperience::where('character_id', $id)->get();
        $characterSkills = CharactersSkill::where('character_id', $id)->get();
        $character->character_experience = $characterExperience;
        $character->character_skills = $characterSkills;
        $character->campaign = $query->campaign;

        return $character;
    }

}
