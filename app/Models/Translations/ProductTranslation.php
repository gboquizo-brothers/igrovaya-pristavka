<?php

namespace App\Models\Translations;

use App\Models\Traits\Uuidable;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use Uuidable;

    public $timestamps = false;

    protected $fillable = ['name'];
}
