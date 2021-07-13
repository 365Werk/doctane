<?php

namespace Werk365\Doctane\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class DockerStatus extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'doctane:status';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Octane server status check';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('Checking server status');
        $container = config('doctane.container_name');
        $image = config('doctane.image_name');
        $port = config('doctane.port');
        $cmd = "docker exec $container php artisan octane:status";
        $result = exec($cmd);
        if (Str::endsWith($result, 'Octane server is running.')) {
            $this->newLine();
            $this->info("Running on 127.0.0.1:$port");
        } else {
            $this->newLine();
            $this->error('Server is not running');
        }
    }
}
