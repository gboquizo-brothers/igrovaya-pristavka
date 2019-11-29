<?php

namespace App\Models\Traits;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

trait Sluggable
{
    use Translatable;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the value of the model's localized route key.
     *
     * @param $locale
     *
     * @return mixed
     */
    public function getLocalizedRouteKey($locale)
    {
        return $this->translate($locale);
    }

    /**
     * @param mixed $value
     *
     * @return Model|void|null
     */
    public function resolveRouteBinding($value)
    {
        return static::whereTranslation('slug', $value)->first() ?? abort(404);
    }
}
