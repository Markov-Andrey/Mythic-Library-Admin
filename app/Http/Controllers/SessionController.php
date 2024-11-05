<?php

namespace App\Http\Controllers;

use App\Models\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function getSessions(): JsonResponse
    {
        $user = Auth::user();
        if (!$user) return response()->json(['error' => 'Unauthenticated'], 401);
        $sessions = Session::where('user_id', $user->id)->get();

        return response()->json($sessions);
    }
}
