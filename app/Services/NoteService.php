<?php

namespace App\Services;

use App\Models\Note;

class NoteService
{
    public static function allNotes($session_id): \Illuminate\Http\JsonResponse
    {
        $query = Note::where('session_id', $session_id);

        $items = $query->get();

        return response()->json($items);
    }

    public static function note($id)
    {
        $note = Note::find($id);

        return response()->json($note);
    }
}
