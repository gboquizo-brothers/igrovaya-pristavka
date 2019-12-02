<?php

namespace App\Models;

use App\Models\Traits\Uuidable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Uuidable, SoftDeletes;

    /**
     * @return MorphTo
     */
    public function productable(): MorphTo
    {
        return $this->morphTo();
    }
}
