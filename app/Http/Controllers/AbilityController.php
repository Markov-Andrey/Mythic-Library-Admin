<?php

namespace App\Http\Controllers;

use App\Services\AbilityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AbilityController extends Controller
{
    public function allAbilities($session_id, Request $request): JsonResponse
    {
        return AbilityService::allAbilities($session_id, $request);
    }
    public function ability($id)
    {
        return AbilityService::ability($id);
    }
}
