<?php

namespace App\Models;

use App\Models\Traits\Uuidable;
use App\Models\Translations\MediaTranslation;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use Translatable, Uuidable;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Name of translation model.
     *
     * @var string
     */
    public $translationModel = MediaTranslation::class;

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

}
