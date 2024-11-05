<?php

namespace App\Http\Controllers;

use App\Services\ItemService;
use Illuminate\Http\JsonResponse;

class ItemController extends Controller
{
    public function allItems($session_id): JsonResponse
    {
        return ItemService::allItems($session_id);
    }
    public function item($id)
    {
        return ItemService::item($id);
    }
}
