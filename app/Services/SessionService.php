<?php

namespace App\Services;

use App\Models\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SessionService
{
    public static function getUserSessions(): JsonResponse
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        $sessions = Session::where('user_id', $user->id)->get();

        $sessions->each(function ($session) {
            $session->preview = $session->preview_url;
        });

        return response()->json($sessions);
    }
    public static function getSession($id): JsonResponse
    {
        $session = Session::where('id', $id)->with('sessionUsers')->first();

        if (!$session) {
            return response()->json(['error' => 'Session not found'], 404);
        }
        $session->preview = $session->preview_url;

        return response()->json($session);
    }
}
