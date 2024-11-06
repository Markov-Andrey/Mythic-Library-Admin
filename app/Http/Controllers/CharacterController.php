<?php

namespace App\Http\Controllers;

use App\Services\CharacterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    public function allCharacters($session_id, Request $request): JsonResponse
    {
        return CharacterService::allCharacters($session_id, $request);
    }
    public function character($id)
    {
        return CharacterService::character($id);
    }
}
