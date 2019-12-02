<?php

namespace App\Models;

use App\Enums\MediaFormatsEnum;
use App\Models\Translations\MediaTranslation;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Product
{
    use CastsEnums;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['format' => 'string'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['format'];

    /**
     * Determine whether an attribute should be cast to a enum.
     *
     * @var array
     */
    protected $enumCasts = ['format' => MediaFormatsEnum::class];

    /**
     * @return MorphTo
     */
    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * @return MorphOne
     */
    public function product(): MorphOne
    {
        return $this->morphOne(Product::class, 'productable');
    }
}
