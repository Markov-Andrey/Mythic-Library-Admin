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
    public static function ExpNexLevel($exp)
    {
        $level = self::Level($exp) + 1;
        $nextLevelRow = self::where('level', '=', $level)
            ->orderBy('points', 'asc')
            ->first();
        if ($nextLevelRow) {
            return $nextLevelRow->points;
        }

        return null;
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
