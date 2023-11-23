<?php


namespace App\Http\Controllers\Api;


use App\Models\Campaign;

class CampaignController
{
    /**
     * @OA\Get(
     *      path="/api/campaigns/{id}",
     *      operationId="getCampaignById",
     *      tags={"Campaigns"},
     *      summary="Get campaign by ID",
     *      description="Returns a single campaign based on the provided ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the campaign",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              properties={
     *                  @OA\Property(property="id", type="integer"),
     *                  @OA\Property(property="name", type="string"),
     *                  @OA\Property(property="description", type="string"),
     *                  @OA\Property(property="created_at", type="string", format="date-time"),
     *                  @OA\Property(property="updated_at", type="string", format="date-time"),
     *              }
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Campaign not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="error", type="string", example="Campaign not found")
     *          )
     *      ),
     * )
     */
    public function getCampaignById($id)
    {
        $campaign = Campaign::CampaignInfo($id);
        if (!$campaign) {
            return response()->json(['error' => 'Campaign not found'], 404);
        }
        return response()->json($campaign);
    }
}
