<?php


namespace App\Models\Campaign;


use App\Models\Campaign;
use App\Models\Character\ShortInfo;

class Info
{
    public static function Info($id)
    {
        $campaign = Campaign::with(['characters:id,campaign_id', 'CampaignNote' => function ($query) {
            $query->orderByDesc('created_at');
        }])->find($id);

        if ($campaign) {
            $charactersWithIds = $campaign->characters;
            $characterIds = $charactersWithIds->pluck('id')->toArray();
            $shortInfo = ShortInfo::Info($characterIds);
            $campaign->short_info = $shortInfo;

            return $campaign;
        } else {
            return null;
        }
    }
}
