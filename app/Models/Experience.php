<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'dnd_experience';

    protected $fillable = [
        'points',
        'level',
        'mastery_bonus',
    ];

    public $timestamps = false;

    public static function Level($exp)
    {
        if (!$exp) {
            return 1;
        }
        $nearestRow = self::where('points', '<=', $exp)
            ->orderBy('points', 'desc')
            ->first();
        if ($nearestRow) {
            return $nearestRow->level;
        }
        return 1;
    }
    public static function MasteryBonus($exp)
    {
        if (!$exp) {
            return 1;
        }
        $nearestRow = self::where('points', '<=', $exp)
            ->orderBy('points', 'desc')
            ->first();
        if ($nearestRow) {
            return $nearestRow->mastery_bonus;
        }
        return 0;
    }
}
