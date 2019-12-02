<?php

namespace App\Models\Translations;

use App\Models\Traits\Uuidable;
use Illuminate\Database\Eloquent\Model;

class FactoryTranslation extends Model
{
    use Uuidable;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
