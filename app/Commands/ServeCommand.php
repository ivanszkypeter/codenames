<?php

namespace App\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\ProcessUtils;

class ServeCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'serve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve the application on the PHP development server';

    /**
     * Execute the console command.
     *
     * @throws \Exception
     *
     * @return void
     */
    public function fire()
    {
        chdir($this->laravel->publicPath());

        $host = $this->input->getOption('host');

        $port = $this->input->getOption('port');

        $base = ProcessUtils::escapeArgument($this->laravel->basePath());

        $this->info("Laravel development server started on http://{$host}:{$port}/");

        passthru("php -S {$host}:{$port} {$base}/server.php & node ../nodejs/socket {$host}");
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['host', null, InputOption::VALUE_OPTIONAL, 'The host address to serve the application on.', '127.0.0.1'],

            ['port', null, InputOption::VALUE_OPTIONAL, 'The port to serve the application on.', 8000],
        ];
    }
}
