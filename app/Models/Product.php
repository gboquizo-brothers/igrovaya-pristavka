<?php

namespace App\Models;

use App\Models\Traits\Uuidable;
use App\Models\Translations\ProductTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model implements TranslatableContract
{
    use SoftDeletes;
    use Translatable;
    use Uuidable;

    public $translatedAttributes = ['name'];

    public function productable(): MorphTo
    {
        return $this->morphTo();
    }

    public function factories(): BelongsToMany
    {
        return $this->belongsToMany(Factory::class);
    }
}
