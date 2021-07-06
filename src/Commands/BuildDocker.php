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
        $image = config('doctane.image_name');
        $cmd = 'cd vendor/werk365/doctane/docker && docker build -t '.$image.' .';
        exec($cmd, $res);

        foreach ($res as $r) {
            $this->info($r);
        }
    }
}
