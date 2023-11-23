<?php


namespace App\Models\Character;

use App\Models\Character;
use App\Models\Experience;

class ShortInfo extends Character
{
    public static function Info($id = null)
    {
        $query = Character::query();
        if ($id !== null) {
            if (is_array($id)) {
                $query->whereIn('id', $id);
            } else {
                $query->where('id', $id);
            }
        }
        $characters = $query->with([
            'genders:id,title',
            'classes:id,name,icon',
            'alignment:id,title',
            'alignment:id,name',
            'races:id,title',
        ])->get();
        $characters = $characters->map(function ($character) {
            $character['level'] = Experience::Level($character->exp);

            return $character;
        });

        return $characters;
    }
}
