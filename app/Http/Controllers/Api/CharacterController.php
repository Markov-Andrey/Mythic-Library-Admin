<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/character/{id}",
     *      operationId="getCharacterById",
     *      tags={"Character"},
     *      summary="Get a character by ID",
     *      description="Returns a single character based on the provided ID",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          description="ID of the character",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer"),
     *              @OA\Property(property="name", type="string"),
     *              @OA\Property(property="level", type="integer"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Character not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Character not found")
     *          )
     *      ),
     * )
     */
    public function getCharacterById($id)
    {
        $character = Character::find($id);
        if (!$character) {
            return response()->json(['error' => 'Character not found'], 404);
        }
        return response()->json($character);
    }
}
