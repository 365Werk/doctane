<?php

namespace Werk365\Doctane\Commands;

use Illuminate\Console\Command;


class DoctaneComposer extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'doctane:composer {arguments?*}';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Run Composer commands in your container';

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
        $cmd = "docker exec $container composer " . implode(' ' , $this->argument('arguments'));
        system($cmd);
     }
}
