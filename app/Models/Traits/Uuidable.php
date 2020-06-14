<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait Uuidable
{
    protected static function bootUuidable(): void
    {
        static::creating(static function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
