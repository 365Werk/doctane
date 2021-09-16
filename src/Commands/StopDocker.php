<?php

namespace Werk365\Doctane\Commands;

use Illuminate\Console\Command;

class StopDocker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'doctane:stop';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stop container';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $container = config('doctane.container_name');
        $image = config('doctane.image_name');
        $port = config('doctane.port');
        $cmd = "docker stop $container";
        passthru($cmd);
    }
}
