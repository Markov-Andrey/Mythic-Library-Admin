<?php


namespace App\Models\Character;

use App\Models\Character;
use App\Models\Characteristics;
use App\Models\CharactersSkill;
use App\Models\Dimensions;
use App\Models\Experience;
use App\Models\Modifier;
use App\Models\Skills;
use stdClass;

class Info extends Character
{
    public static function Info($id)
    {
        $query = Character::with([
            'Classes:id,name,icon,health_bonus,basic_health,health_per_level,alternative_health_per_level',
            'Genders:id,title',
            'Races',
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
            'health_current' => $query->health_current,
            'health_max' => $query->health_max,
        ];
        $character->params = (object)[
            // all bonuses
            'strength' => $query->strength,
            'dexterity' => $query->dexterity,
            'constitution' => $query->constitution,
            'intelligence' => $query->intelligence,
            'wisdom' => $query->wisdom,
            'charisma' => $query->charisma,
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

        $character->character_experience = (object)[
            'exp' => $query->exp,
            'level' => Experience::Level($query->exp),
            'exp_next_level' => Experience::ExpNexLevel($query->exp),
            'master_bonus' => Experience::MasteryBonus($query->exp),
        ];

        $size = Dimensions::find($query->races->size_id);
        $character->size = (object)[
            'speed' => $query->races->speed,
            'size' => $size->title,
            'space' => $size->space,
            'carrying' => $size->carrying * $character->params->strength,
            'pushing' => $size->pushing * $character->params->strength,
        ];

        $characterSkills = CharactersSkill::where('character_id', $id)->get();
        $character->character_skills = $characterSkills;

        $character->campaign = $query->campaign;

        return $character;
    }
}
