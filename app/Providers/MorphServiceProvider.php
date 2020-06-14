<?php

namespace App\Providers;

use Closure;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

class MorphServiceProvider extends ServiceProvider
{
    private Filesystem $system;

    /**
     * Register morphMap.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->system = app(Filesystem::class);

        Relation::morphMap($this->mapModels());
    }

    /**
     * Map all models to morphed name.
     *
     * @return array
     */
    public function mapModels(): array
    {
        $models = collect($this->system->allFiles(app_path('Models')));

        return $models->map(Closure::fromCallable([$this, 'relate']))->collapse()->toArray();
    }

    /**
     * Make an array with model name, and his morph.
     *
     * @param  SplFileInfo  $model
     *
     * @return array
     */
    public function relate(SplFileInfo $model): array
    {
        $name = $model->getFilenameWithoutExtension();

        $modelName = str_replace(['/', '.php'], ['\\', ''], $model->getRelativePathname());

        return [Str::snake($name) => "App\\Models\\{$modelName}"];
    }
}
