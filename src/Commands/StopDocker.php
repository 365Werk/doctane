<?php

namespace Werk365\Doctane\Commands;

use Illuminate\Console\Command;


class StopDocker extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'doctane:stop';

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
        $cmd = 'cd vendor/werk365/doctane/docker && docker compose down';
        exec($cmd, $res);

        foreach($res as $r){
            $this->info($r);
        }
    }
}
