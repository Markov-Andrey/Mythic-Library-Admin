<?php

namespace App\Services;

use App\Models\Location;

class LocationService
{
    public static function allLocations($session_id): \Illuminate\Http\JsonResponse
    {
        $locations = Location::where('session_id', $session_id)->get();
        $locationsArray = $locations->keyBy('id');
        $hierarchicalLocations = [];

        foreach ($locationsArray as $location) {
            if (is_null($location->parent_id)) {
                $hierarchicalLocations[$location->id] = self::buildLocationHierarchy($location, $locationsArray);
            }
        }

        return response()->json(array_values($hierarchicalLocations));
    }

    private static function buildLocationHierarchy($location, $locationsArray): array
    {
        $children = [];

        foreach ($locationsArray as $potentialChild) {
            if ($potentialChild->parent_id == $location->id) {
                $children[] = self::buildLocationHierarchy($potentialChild, $locationsArray);
            }
        }

        $previewUrl = !empty($location->images) ? asset("storage/locations/{$location->images[0]}") : null;

        return [
            'id' => $location->id,
            'image' => $previewUrl,
            'name' => $location->name,
            'type' => $location->type,
            'children' => $children,
        ];
    }
}
