<?php

namespace App\Models\Translations;

use App\Models\Traits\Uuidable;
use Illuminate\Database\Eloquent\Model;

class FactoryTranslation extends Model
{
    use Uuidable;

    public $timestamps = false;

    protected $fillable = ['name'];
}
