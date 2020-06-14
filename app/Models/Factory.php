<?php

namespace App\Models;

use App\Models\Traits\Uuidable;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Factory extends Model implements TranslatableContract
{
    use SoftDeletes;
    use Translatable;
    use Uuidable;

    public $translatedAttributes = ['name'];

    public function factoriable(): MorphTo
    {
        return $this->morphTo();
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
