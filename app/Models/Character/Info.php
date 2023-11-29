<?php


namespace App\Models\Character;

use App\Models\Backpack;
use App\Models\Character;
use App\Models\Characteristics;
use App\Models\CharactersSkill;
use App\Models\CharactersSpell;
use App\Models\ClassesSpellSlot;
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
            'Classes.savingThrows',
            'Genders:id,title',
            'Races',
            'Alignment:id,title',
            'CharacterExperience',
            'CharacterSkills',
            'CharacterSpell',
            'Campaign'
        ])->find($id);

        $character = new stdClass();
        $character->info = (object)[
            'id' => $query->id,
            'name' => $query->name,
            'logo' => $query->logo,
            'gender' => $query->genders->title,
            'race' => $query->races->title,
            'alignment' => $query->races->alignment,
            'inspiration' => $query->inspiration,
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

        $level = Experience::Level($query->exp);
        $id_class= $query->classes->id;
        $spellSlots = ClassesSpellSlot::where('class_id', $id_class)
            ->where('character_level', $level)
            ->first();
        $character->spell_slots = (object)[
            'known_conspiracies' => $spellSlots->known_conspiracies ?? null,
            'known_spells' => $spellSlots->known_spells ?? null,
            'spell_slots_level_1' => $spellSlots->spell_slots_level_1 ?? null,
            'spell_slots_level_2' => $spellSlots->spell_slots_level_2 ?? null,
            'spell_slots_level_3' => $spellSlots->spell_slots_level_3 ?? null,
            'spell_slots_level_4' => $spellSlots->spell_slots_level_4 ?? null,
            'spell_slots_level_5' => $spellSlots->spell_slots_level_5 ?? null,
            'spell_slots_level_6' => $spellSlots->spell_slots_level_6 ?? null,
            'spell_slots_level_7' => $spellSlots->spell_slots_level_7 ?? null,
            'spell_slots_level_8' => $spellSlots->spell_slots_level_8 ?? null,
            'spell_slots_level_9' => $spellSlots->spell_slots_level_9 ?? null,
        ];
        // TODO персонажу добавь отслеживание текущих ячеек заклинаний

        $character->saving_throws = $query->classes->savingThrows
            ->map(function ($savingThrow) {
                return $savingThrow->characteristic->code;
            })
            ->all();

        $character->character_experience = (object)[
            'exp' => $query->exp,
            'level' => $level,
            'exp_next_level' => Experience::ExpNexLevel($query->exp),
            'master_bonus' => Experience::MasteryBonus($query->exp),
        ];

        $size = Dimensions::find($query->races->size_id);
        $character->size = (object)[
            'speed' => $query->races->speed,
            'size' => $size->title,
            'space' => $size->space,
        ];

        $character->armor_class = (object)[];
        $character->armor_class->{'Без брони'} = 10 + $character->basic_modifier->dexterity;
        if ($query->races->title == 'Людоящер') {
            $character->armor_class->{'Природный доспех (Людоящер)'} = 13 + $character->basic_modifier->dexterity;
        }

        $characterSkills = CharactersSkill::with('skill')->where('character_id', $id)->get();
        $character->skills = collect($dndSkills)->pluck('code')->mapWithKeys(fn ($code) => [$code => 0]);
        $skillCodeCounts = $characterSkills->pluck('skill.code')->countBy();
        $character->skills = $character->skills->merge($skillCodeCounts)->all();

        $characterSpells = CharactersSpell::with('spell')->where('character_id', $id)->get();
        $character->spells = $characterSpells->map(function ($characterSpell) {
            return [
                'title' => $characterSpell->spell->title,
                'description' => $characterSpell->spell->description,
                'properties' => $characterSpell->spell->properties,
                'image' => $characterSpell->spell->image,
                'level' => $characterSpell->spell->level,
            ];
        })->toArray();

        $backpack = Backpack::with('item', 'item.types.itemType')->where('character_id', $id)->orderByDesc('created_at')->get();
        $character->backpack = $backpack->map(function ($entry) {
            $typesString = $entry->item->types->map(function ($type) {
                return $type->itemType->name;
            })->implode(', ');
            return [
                'item_id' => $entry->item->id,
                'image' => $entry->item->image,
                'title' => $entry->item->title,
                'description' => $entry->item->description,
                'value' => $entry->item->value,
                'weight' => $entry->item->weight,
                'quantity' => $entry->quantity,
                'studied' => $entry->item->studied,
                'types' => $typesString,
            ];
        });

        $totalWeight = 0;
        foreach ($character->backpack as $item) {
            $totalWeight += $item['quantity'] * $item['weight'];
        }
        $character->weight = (object)[
            'backpack' => round($totalWeight, 3),
            'carrying' => $size->carrying * $character->params->strength,
            'pushing' => $size->pushing * $character->params->strength,
        ];

        $character->campaign = $query->campaign;

        return $character;
    }
}
