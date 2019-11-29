<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class IdeHelperCommand extends Command
{
    /**
     * Name of the deploy command with environment
     *
     * @var string
     */
    protected $signature = 'ide-helper:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate all ide helper for PhpStorm';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        foreach (['ide-helper:generate', 'ide-helper:meta', 'ide-helper:models'] as $command) {
            if ($command === 'ide-helper:models') {
                $attribute = ['--nowrite' => true];
            }

            $this->info("Launching {$command}...");
            Artisan::call($command, $attribute ?? []);
            sleep(1);
        }
    }
}
