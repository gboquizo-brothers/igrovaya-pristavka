<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class DeployCommand extends Command
{
    /**
     * Name of the deploy command with environment1
     *
     * @var string
     */
    protected $signature = 'deploy --env';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy all necessary into the server';

    /**
     * Process instance.
     *
     * @var Process
     */
    protected $process;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->runCommands(['composer install', 'npm install', 'npm run routes']);

        switch ($this->option('env')) {
            case 'development':
            case 'dev':
                $this->command('npm run dev')->stop(0);
                break;
            case 'prod':
            case 'production':
                $this->command('npm run production')->stop(0);
                $this->runCommands(['cache:clear', 'route:cache', 'view:clear'], true);
                break;
            default:
                $this->info('Not environment chosen. JS and CSS not preprocessed.');
                break;
        }
    }

    /**
     * Run a command in console.
     *
     * @param  array  $commands
     * @param  bool  $artisan
     * @return DeployCommand
     */
    private function runCommands(array $commands, $artisan = false): DeployCommand
    {
        if (!$artisan) {
            foreach ($commands as $command) {
                $this->info("Launching {$command}...");
                $this->command($command, 180)->stop(0);
            }
        }

        if ($artisan) {
            foreach ($commands as $command) {
                $this->info("Launching {$command}...");
                Artisan::call($command);
                sleep(1);
            }
        }

        return $this;
    }

    /**
     * Run a command.
     *
     * @param $string
     * @param  integer  $timeout
     * @return Process
     */
    private function command($string, $timeout = 60): Process
    {
        $this->process = new Process($string);
        $this->process->setTimeout($timeout)->run();

        return $this->process;
    }
}
