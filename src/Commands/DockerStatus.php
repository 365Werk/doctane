<?php

namespace Werk365\Doctane\Commands;

use Illuminate\Console\Command;


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
    protected $description = 'asd';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $container = config('doctane.container_name');;
        $image = config('doctane.image_name');
        $port = config('doctane.port');
        $cmd = "docker exec $container php artisan octane:status";
        
        passthru($cmd);

        $this->info("Running on 127.0.0.1:$port");
    }
}
