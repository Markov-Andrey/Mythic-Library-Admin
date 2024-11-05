<?php

namespace App\Http\Controllers;

use App\Services\ItemService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function allItems($session_id, Request $request): JsonResponse
    {
        return ItemService::allItems($session_id, $request);
    }
    public function item($id)
    {
        return ItemService::item($id);
    }
    public function types($id)
    {
        return ItemService::types($id);
    }
}
