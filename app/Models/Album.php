<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public function band()
    {
    //cada álbum pertence a 1 banda.
    return $this->belongsTo(Band::class);
    }
}
