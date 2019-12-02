<?php

namespace App\Models;

use App\Models\Traits\Uuidable;
use App\Models\Translations\ProductTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Product extends Model implements TranslatableContract
{
    use Translatable, Uuidable, SoftDeletes;

    /**
     * Name of translation model.
     *
     * @var string
     */
    public $translationModel = ProductTranslation::class;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * @return MorphTo
     */
    public function productable(): MorphTo
    {
        return $this->morphTo();
    }
}
