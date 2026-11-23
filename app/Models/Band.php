<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;


#[Fillable(['name', 'photo'])]

class Band extends Model
{
    public function albums()
    {
        return $this->hasMany(Album::class);
    }

}
