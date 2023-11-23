<?php

namespace App\Models;

use App\Models\Campaign\Info;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $table = 'dnd_campaigns';

    protected $fillable = [
        'title',
        'description',
        'setting',
        'image'
    ];

    /*
     * RELATION
     */
    public function Characters()
    {
        return $this->hasMany(Character::class, 'campaign_id');
    }

    /*
     * FUNCTIONS
     */
    public static function CampaignInfo($id)
    {
        return Info::Info($id);
    }

}
