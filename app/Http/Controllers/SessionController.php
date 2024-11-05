<?php

namespace App\Http\Controllers;

use App\Services\SessionService;
use Illuminate\Http\JsonResponse;

class SessionController extends Controller
{
    public function getUserSessions(): JsonResponse
    {
        $response = SessionService::getUserSessions();

        return response()->json($response);
    }

    public function getSession($session_id): JsonResponse
    {
        $response = SessionService::getSession($session_id);

        return response()->json($response);
    }
}
