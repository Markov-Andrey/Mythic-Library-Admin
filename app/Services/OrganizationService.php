<?php

namespace App\Services;

use App\Models\Organization;

class OrganizationService
{
    public static function organization($id): \Illuminate\Http\JsonResponse
    {
        $organization = Organization::where('id', $id)->first();

        if (!$organization) {
            return response()->json(['error' => 'Location not found'], 404);
        }

        return response()->json($organization);
    }
    public static function allOrganizations($session_id): \Illuminate\Http\JsonResponse
    {
        $organizations = Organization::where('session_id', $session_id)->get();

        return response()->json($organizations);
    }
}
