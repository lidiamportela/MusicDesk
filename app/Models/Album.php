<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;


#[Fillable(['band_id', 'name', 'photo', 'release_date'])]

class Album extends Model
{
    protected $casts = [
        'release_date' => 'date',
    ];

    public function band()
    {
    //cada álbum pertence a 1 banda.
    return $this->belongsTo(Band::class);
    }
}
