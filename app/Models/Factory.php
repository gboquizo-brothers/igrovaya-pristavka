<?php

namespace App\Models;

use App\Models\Traits\Uuidable;
use App\Models\Translations\FactoryTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Factory extends Model implements TranslatableContract
{
    use Translatable, Uuidable, SoftDeletes;

    /**
     * Name of translation model.
     *
     * @var string
     */
    public $translationModel = FactoryTranslation::class;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * @return MorphTo
     */
    public function factoriable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
