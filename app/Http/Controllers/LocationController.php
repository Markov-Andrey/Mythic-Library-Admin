<?php

namespace App\Http\Controllers;

use App\Services\LocationService;
use Illuminate\Http\JsonResponse;

class LocationController extends Controller
{
    public function allLocations($session_id): JsonResponse
    {
        return LocationService::allLocations($session_id);
    }
}
