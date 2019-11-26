<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait Uuidable
{
    protected static function bootUuidable()
    {
        static::creating(static function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
