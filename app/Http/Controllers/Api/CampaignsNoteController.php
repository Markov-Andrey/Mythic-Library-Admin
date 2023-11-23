<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\CampaignNote;

class CampaignsNoteController
{
    /**
     * @OA\Post(
     *     path="/api/campaign-notes",
     *     operationId="storeCampaignNote",
     *     tags={"Campaign Notes"},
     *     summary="Create a new campaign note",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Campaign Note data",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="campaign_id",
     *                     type="integer",
     *                     description="ID of the campaign",
     *                     example=1
     *                 ),
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     description="Title of the note",
     *                     example="My Campaign Note"
     *                 ),
     *                 @OA\Property(
     *                     property="tags",
     *                     type="string",
     *                     description="Tags for the note",
     *                     example="tag1, tag2"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     description="Description of the note",
     *                     example="This is a note about my campaign."
     *                 ),
     *                 @OA\Property(
     *                     property="personal_note",
     *                     type="boolean",
     *                     description="Indicates if the note is personal",
     *                     example=true
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'campaign_id' => 'required|exists:dnd_campaigns,id',
            'title' => 'required|string',
            'tags' => 'nullable|string',
            'description' => 'nullable|string',
            'personal_note' => 'required|boolean',
        ]);

        $campaignNote = CampaignNote::create($validatedData);

        return response()->json($campaignNote, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/campaign-notes/{id}",
     *     operationId="updateCampaignNote",
     *     tags={"Campaign Notes"},
     *     summary="Update a campaign note",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the campaign note",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Campaign note not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'string',
            'tags' => 'string|nullable',
            'description' => 'string|nullable',
            'personal_note' => 'boolean',
        ]);

        $campaignNote = CampaignNote::findOrFail($id);
        $campaignNote->update($validatedData);

        return response()->json($campaignNote, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/campaign-notes/{id}",
     *     operationId="destroyCampaignNote",
     *     tags={"Campaign Notes"},
     *     summary="Delete a campaign note",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the campaign note",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Campaign note not found"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function destroy($id)
    {
        $campaignNote = CampaignNote::findOrFail($id);
        $campaignNote->delete();

        return response()->json(null, 204);
    }
}
