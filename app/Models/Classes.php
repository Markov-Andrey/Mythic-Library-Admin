<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'dnd_classes';

    protected $fillable = [
        'icon',
        'name',
        'description',
        'health_bonus',
        'basic_health',
        'health_per_level',
        'alternative_health_per_level'
    ];

    public $timestamps = false;

    /*
     * RELATION
     */
    public function savingThrows()
    {
        return $this->hasMany(ClassesSavingThrows::class, 'class_id');
    }
    public function classesSpellSlots()
    {
        return $this->hasMany(ClassesSpellSlot::class, 'class_id');
    }

}
