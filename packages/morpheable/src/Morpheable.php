<?php

declare(strict_types=1);

namespace Boquizo\Inheritance;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

trait Morpheable
{
    /**
     * Morphed attributes.
     *
     * @var array
     */
    protected $morphed = [];

    /**
     * @override Model newFromBuilder method
     *
     * @param array $attributes
     * @param null $connection
     *
     * @return Model
     */
    public function newFromBuilder($attributes = [], $connection = null): Model
    {
        $model = parent::newFromBuilder($attributes, $connection);

        // This is the entry point for morpheables attributes.
        if (isset($model->morpheables) && (config('inheritance.spread') ?? true)) {
            $this->mergeMorpheables($model);
        }

        return $model;
    }

    /**
     * Merge all morpheable attributes.
     *
     * @param Model $model
     */
    private function mergeMorpheables(Model $model): void
    {
        $object = $model;

        foreach ($this->inheritance($model) as $parent) {
            $object = $object->{lcfirst(class_basename($parent))};

            if ($object !== null && !empty($model->morpheables)) {
                $this->mergeAttributes($model, $object);
            }
        }
    }

    /**
     * Merge parents attributes to children.
     *
     * @param $model
     * @param $object
     */
    private function mergeAttributes(Model $model, $object): void
    {
        $attributes = $object->getAttributes();

        if (config('inheritance.translatable') ?? false) {
            $attributes = $this->mergeTranslatables($object);
        }

        $this->fillAttributes($model, $attributes);
    }

    /**
     * Extract all inheritance except laravel Model.
     *
     * @param Model $model
     *
     * @return Collection
     */
    private function inheritance(Model $model): Collection
    {
        return collect(class_parents($model))->forget(Model::class);
    }

    /**
     * Merge all translatables attributes.
     *
     * @param $object
     *
     * @return array
     */
    private function mergeTranslatables(Model $object): array
    {
        return array_merge($this->extractTranslations($object), $object->getAttributes());
    }

    /**
     * Extract all attributes for a translation.
     *
     * @param Model $object
     *
     * @return array|null
     */
    private function extractTranslations(Model $object): array
    {
        try {
            return $object->hasTranslation() ? $object->getTranslation()->getAttributes() : [];
        } catch (QueryException $exception) {
            return [];
        }
    }

    /**
     * Fill morphed and new attributes to model.
     *
     * @param Model $model
     * @param array $attributes
     */
    private function fillAttributes(Model $model, $attributes = []): void
    {
        foreach ($model->morpheables as $attribute) {
            if (array_key_exists($attribute, $attributes)) {
                foreach (['attributes', 'morphed'] as $fill) {
                    $model->$fill[$attribute] = $attributes[$attribute];
                }
            }
        }
    }
}
