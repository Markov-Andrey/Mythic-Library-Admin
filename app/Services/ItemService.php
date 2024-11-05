<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Location;

class ItemService
{
    public static function item($id): \Illuminate\Http\JsonResponse
    {
        $item = Item::where('id', $id)->first();

        if (!$item) {
            return response()->json(['error' => 'Location not found'], 404);
        }

        if (isset($item->images) && !empty($item->images)) {
            $item->images = array_map(function ($image) {
                return asset("storage/items/{$image}");
            }, $item->images);
        } else {
            $item->images = [];
        }

        return response()->json($item);
    }
    public static function allItems($session_id, $request): \Illuminate\Http\JsonResponse
    {
        $types = $request->input('type');
        $query = Item::where('session_id', $session_id);

        if ($types) {
            $typesArray = array_map('trim', explode(',', $types));
            $query->whereIn('type', $typesArray);
        }
        $items = $query->get();

        return response()->json($items);
    }
    public static function types($session_id): \Illuminate\Http\JsonResponse
    {
        $types = Item::where('session_id', $session_id)->whereNotNull('type')->distinct()->pluck('type');

        return response()->json($types);
    }
}
