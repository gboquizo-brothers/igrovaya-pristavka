<?php

namespace App\Models;

use App\Enums\MediaFormatsEnum;
use BenSampo\Enum\Traits\CastsEnums;
use Boquizo\Inheritance\Morphable;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Product
{
    use CastsEnums;
    use Morphable;

    protected $casts = ['format' => 'string'];
    protected $morphables = ['name'];
    protected $fillable = ['format'];
    protected $enumCasts = ['format' => MediaFormatsEnum::class];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }

    public function product(): MorphOne
    {
        return $this->morphOne(Product::class, 'productable');
    }
}
