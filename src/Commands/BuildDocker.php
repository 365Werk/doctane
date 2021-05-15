<?php

namespace Werk365\Doctane\Commands;

use Illuminate\Console\Command;


class BuildDocker extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'doctane:build';

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
        $cmd = 'cd packages/werk365/doctane/docker && docker compose down';
        exec($cmd);
        $cmd = 'cd packages/werk365/doctane/docker && docker compose up -d --build';
        exec($cmd, $res);

        foreach($res as $r){
            $this->info($r);
        }
        // $this->info('Using the SensioLabs Security Checker the composer.lock of the package is scanned for known security vulnerabilities in the dependencies.');
    }
}
