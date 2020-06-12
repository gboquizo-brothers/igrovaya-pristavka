<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Closure;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Process\Process;

class DeployCommand extends Command
{
    /**
     * Name of deploy command with environment
     *
     * @var string
     */
    protected $signature = 'deploy {env? : Environment} {--output : Show output}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploy all necessary into the server';

    /**
     * @var Process
     */
    protected Process $process;

    /**
     * @var array
     */
    protected array $environments = ['dev', 'development', 'prod', 'production'];

    /**
     * @var bool
     */
    protected bool $console = false;

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $environment = $this->checkEnvironment();

        if (! $this->option('output')) {
            $this->console = $this->choice('Do you want to see the output?', ['yes', 'no'], 'no') !== 'no';
        }

        $this->selectEnvironment($environment);

        $this->info('All done!');
    }

    /**
     * Run commands for development environment.
     *
     * @return void
     */
    protected function development(): void
    {
        $this->runCommands(['composer install', 'npm install', 'npm run dev']);
    }

    /**
     * Run commands for production environment.
     *
     * @return void
     */
    protected function production(): void
    {
        $this->runCommands(['composer install --no-dev', 'npm install --production', 'npm run production']);
        $this->artisanCommands(['config:cache', 'route:trans:cache', 'view:clear']);
    }

    /**
     * Check if has environment;
     *
     * @return string
     */
    protected function checkEnvironment(): string
    {
        $environment = $this->argument('env');

        if ($environment === null || ! in_array($environment, $this->environments, true)) {
            $environment = $this->choice('What environment?', ['development', 'production'], 'development');
        }

        return $environment;
    }

    /**
     * Run commands in console.
     *
     * @param array $commands
     *
     * @return void
     */
    protected function runCommands(array $commands): void
    {
        foreach ($commands as $command) {
            if (! $this->console) {
                $this->line("Launching {$command}...");
            }
            $this->command($command, 180)->stop(0);
        }
    }

    /**
     * Run artisan commands.
     *
     * @param array $commands
     */
    protected function artisanCommands(array $commands): void
    {
        foreach ($commands as $command) {
            if (! $this->console) {
                $this->line("Launching {$command}...");
            }
            Artisan::call($command);
            sleep(5);
        }
    }

    /**
     * Run a command.
     *
     * @param  string|array  $string
     * @param  int  $timeout
     *
     * @return Process
     */
    protected function command($string, int $timeout = 60): Process
    {
        $this->process = new Process($string);
        $this->process->setTimeout($timeout)->run($this->showOutput());
        $this->process->getOutput();

        return $this->process;
    }

    /**
     * Show output for commands.
     *
     * @return Closure|null
     */
    protected function showOutput(): ?Closure
    {
        if ($this->console || $this->option('output')) {
            return static function ($type, $buffer) {
                echo $buffer;
            };
        }

        return null;
    }

    /**
     * Select environment.
     *
     * @param string $environment
     */
    protected function selectEnvironment(string $environment): void
    {
        switch ($environment) {
            case 'development':
            case 'dev':
                $this->development();
                break;
            case 'prod':
            case 'production':
                $this->production();
                break;
        }
    }
}
