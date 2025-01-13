<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Type extends Model
{
     /**
      * The movies that belong to the Type
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
      */
     public function movies(): BelongsToMany
     {
         return $this->belongsToMany(Movie::class);
     }
}
