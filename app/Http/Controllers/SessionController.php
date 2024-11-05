<?php

namespace App\Http\Controllers;

use App\Services\SessionService;
use Illuminate\Http\JsonResponse;

class SessionController extends Controller
{
    public function getUserSessions(): JsonResponse
    {
        return SessionService::getUserSessions();
    }

    public function getSession($id): JsonResponse
    {
        return SessionService::getSession($id);
    }
}
