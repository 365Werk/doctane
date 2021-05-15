<?php

namespace Werk365\Doctane\Commands;

use Illuminate\Console\Command;


class StartDocker extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'doctane:start';

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
        $cmd = 'cd packages/werk365/doctane/docker && docker compose up -d && docker compose exec zwoel php artisan octane:start --host=0.0.0.0 --workers=4 --task-workers=6';
        exec($cmd, $res);
        foreach($res as $r){
            $this->info($r);
        }
        return true;
        // $this->info('Using the SensioLabs Security Checker the composer.lock of the package is scanned for known security vulnerabilities in the dependencies.');
    }
}
