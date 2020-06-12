<?php

namespace App\Models;

use App\Enums\MediaFormatsEnum;
use BenSampo\Enum\Traits\CastsEnums;
use Boquizo\Inheritance\Morphable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Product
{
    use CastsEnums, Morphable;

    /**
     * The attributes that are morphables.
     *
     * @var array
     */
    protected $morphables = ['name'];

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
