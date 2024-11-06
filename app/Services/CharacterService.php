<?php

namespace App\Services;

use App\Models\Character;

class CharacterService
{
    public static function character($id): \Illuminate\Http\JsonResponse
    {
        $item = Character::with([
            'inventoryWithItems',
            'abilitiesWithDetails',
        ])->find($id);
        if (!$item) return response()->json(['error' => 'Location not found'], 404);
        $item->avatar = !empty($item->avatar) ? asset("storage/avatars/{$item->avatar}") : null;

        return response()->json($item);
    }
    public static function allCharacters($session_id, $request): \Illuminate\Http\JsonResponse
    {
        $types = $request->input('type');
        $query = Character::where('session_id', $session_id);

        if ($types) {
            $typesArray = array_map('trim', explode(',', $types));
            $query->whereIn('type', $typesArray);
        }
        $items = $query->get();

        return response()->json($items);
    }
}
