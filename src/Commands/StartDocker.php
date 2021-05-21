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
    protected $description = 'Run container from image';

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
        $cmd = "docker ps -q -f name=$container";
        exec($cmd, $res);
        if($res){
            $this->info("Container is already running, doctane:stop the container first");
            return false;
        }
        // Check if container exists
        // Check if container exists
        $this->info("Checking if $container exists");
        $cmd = "docker ps -aq -f status=exited -f name=$container";
        exec($cmd, $res);

        if($res){
            $this->info("Cleaning containers");
            $cmd = "docker rm $container";
            passthru($cmd);
        }
        $this->info("Creating new $container from $image");
        $cmd = "docker run -d --name $container -v ".getcwd().":/home/application -i -t -p $port:8000 $image";
        passthru($cmd);

        $cmd = "docker exec $container composer show";
        exec($cmd, $res);
        $res = implode($res);
        $pos = strpos($res, "laravel/octane");
        if($pos === false){
            passthru("docker exec $container composer require laravel/octane");
            passthru("docker exec $container php artisan octane:install --server=swoole");
        }
        passthru("docker exec -d $container php artisan octane:start --host=0.0.0.0 --workers=4 --task-workers=8");
        $this->info("Checking octane server status");
        sleep(2);
        $cmd = "docker exec $container php artisan octane:status";
        passthru($cmd);

        $this->info("Running on 127.0.0.1:$port");

        return true;
    }
}
