<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modifier extends Model
{
    use HasFactory;

    protected $table = 'dnd_modifier';

    protected $fillable = [
        'value',
        'modifier'
    ];

    public $timestamps = false;

    public static function Calculate($digit)
    {
        $modifier = self::where('value', '=' , $digit)->first();
        if ($modifier) {
            return $modifier->modifier;
        }
        $maxValue = self::max('value');
        $max = self::where('value', $maxValue)->first();
        if ($digit > $max->value) {
            return $max->modifier;
        }
        $minValue = self::min('value');
        $min = self::where('value', $minValue)->first();
        if ($digit < $min->value) {
            return $min->modifier;
        }
        return 0;
    }
}
