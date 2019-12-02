<?php

namespace Boquizo\Inheritance;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class MorpheableServiceProvider extends IlluminateServiceProvider
{
    /**
     * Boot.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config.php', 'inheritance'
        );

        $this->publishes([
            __DIR__.'/../config.php' => config_path('inheritance.php'),
        ], 'inheritance');
    }
}
