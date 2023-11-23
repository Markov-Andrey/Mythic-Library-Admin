<?php


namespace App\Http\Controllers\Api;

use App\Models\Campaign;
use App\Models\Character;

class MainPageController
{
    /**
     * @OA\Get(
     *      path="/api/main-page/characters",
     *      operationId="getAllCharacters",
     *      tags={"Main Page"},
     *      summary="Get all characters with short information",
     *      description="Returns a list of characters with basic information.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="id", type="integer"),
     *                  @OA\Property(property="name", type="string"),
     *                  @OA\Property(property="level", type="integer"),
     *                  @OA\Property(property="gender", type="object"),
     *                  @OA\Property(property="class", type="object"),
     *                  @OA\Property(property="alignment", type="object"),
     *                  @OA\Property(property="race", type="object"),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Characters not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Characters not found")
     *          )
     *      ),
     * )
     */
    public function getAllCharacters()
    {
        return Character::CharacterShortInfo();
    }

    /**
     * @OA\Get(
     *      path="/api/main-page/campaigns",
     *      operationId="getAllCampaigns",
     *      tags={"Main Page"},
     *      summary="Get all campaigns with short information",
     *      description="Returns a campaigns with basic information.",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="id", type="integer"),
     *                  @OA\Property(property="title", type="string"),
     *                  @OA\Property(property="description", type="text"),
     *                  @OA\Property(property="setting", type="string"),
     *                  @OA\Property(property="image", type="string"),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Campaigns not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Characters not found")
     *          )
     *      ),
     * )
     */
    public function getAllCampaigns()
    {
        return Campaign::all();
    }
}
