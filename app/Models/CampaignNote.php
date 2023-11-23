<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CampaignNote extends Model
{
    use HasFactory;

    protected $table = 'dnd_campaign_notes';

    protected $fillable = [
        'id',
        'campaign_id',
        'title',
        'tags',
        'description',
        'personal_note'
    ];


    /*
     * RELATION
     */
    public function Campaign()
    {
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
