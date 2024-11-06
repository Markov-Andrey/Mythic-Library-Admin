<?php

namespace App\Services;

use App\Models\Ability;

class AbilityService
{
    public static function ability($id): \Illuminate\Http\JsonResponse
    {
        $item = Ability::find($id);
        if (!$item) return response()->json(['error' => 'Location not found'], 404);
        $item->image = !empty($item->image) ? asset("storage/abilities/{$item->image}") : null;

        return response()->json($item);
    }
    public static function allAbilities($session_id, $request): \Illuminate\Http\JsonResponse
    {
        $types = $request->input('type');
        $query = Ability::where('session_id', $session_id);

        if ($types) {
            $typesArray = array_map('trim', explode(',', $types));
            $query->whereIn('type', $typesArray);
        }
        $items = $query->get();
        $items = $items->map(function ($item) {
            $item->image = $item->full_image_path;
            return $item;
        });

        return response()->json($items);
    }
}
