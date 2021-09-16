<?php

namespace Werk365\Doctane\Commands;

use Illuminate\Console\Command;

class DoctaneBash extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'doctane:bash';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Used to bash into your container';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $container = config('doctane.container_name');
        $this->info("Now entering your container, type 'exit' to leave");
        $cmd = "docker exec -t -i $container bash";
        passthru($cmd);
    }
}
