<?php

namespace Boquizo\Inheritance;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class MorphableServiceProvider extends IlluminateServiceProvider
{
    /**
     * Boot.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config.php', 'morphable');

        $this->publishes([
            __DIR__ . '/../config.php' => config_path('morphable.php'),
        ], 'morphable');
    }
}
