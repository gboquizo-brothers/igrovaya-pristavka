<?php

Artisan::command('ide-helper:all', function () {
    foreach (['ide-helper:generate', 'ide-helper:meta', 'ide-helper:models'] as $command) {
        if ($command === 'ide-helper:models') {
            $attribute = ['--nowrite' => true];
        }

        $this->info("Launching {$command}...");
        Artisan::call($command, $attribute ?? []);
        sleep(1);
    }
})->describe('Generate all ide helper for PhpStorm');
