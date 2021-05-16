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
        $container = config('doctane.container_name');;
        $image = config('doctane.image_name');
        $port = config('doctane.port');
        // Check if container exists
        $this->info("Checking if $container exists");
        $cmd = "docker ps -aq -f status=exited -f name=$container";
        exec($cmd, $res);
        
        if($res){
            $this->info("Cleaning containers");
            $cmd = "docker rm $container";
            exec($cmd);
        }
        $this->info("Creating new $container from $image");
        $cmd = "docker run -d --name $container -v ".getcwd().":/home/application -i -t -p $port:8000 $image";
        
        exec($cmd, $res);
        foreach($res as $r){
            $this->info($r);
        }
        $this->info("Checking octane server status");
        sleep(5);
        $cmd = "docker exec $container php artisan octane:status";
        
        exec($cmd, $res);
        foreach($res as $r){
            $this->info($r);
        }
        $this->info("Running on 127.0.0.1:$port");

        return true;
    }
}
