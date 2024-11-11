<?php

namespace App\Http\Controllers;

use App\Services\NoteService;
use Illuminate\Http\JsonResponse;

class NoteController extends Controller
{
    public function allNotes($session_id): JsonResponse
    {
        return NoteService::allNotes($session_id);
    }
    public function note($id)
    {
        return NoteService::note($id);
    }
}
