<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphOne;

class Book extends Media
{
    /**
     * @return MorphOne
     */
    public function media(): MorphOne
    {
        return $this->morphOne(Media::class, 'mediable');
    }
}
