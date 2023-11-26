<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassesSavingThrows extends Model
{
    use HasFactory;

    protected $table = 'dnd_classes_saving_throws';

    protected $fillable = [
        'class_id',
        'characteristic_id',
    ];


    /*
     * RELATION
     */
    public $timestamps = false;

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function characteristic()
    {
        return $this->belongsTo(Characteristics::class, 'characteristic_id');
    }
}
