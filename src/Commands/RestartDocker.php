<?php

namespace Werk365\Doctane\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class RestartDocker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'doctane:restart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Quick restart container container';

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
        $workers = config('doctane.workers') ?? 4;
        $taskWorkers = config('doctane.task_workers') ?? 8;
        $cmd = "docker stop $container";
        exec($cmd, $res);
        if (! $res) {
            $this->error('Something went wrong, try using doctane:stop');

            return;
        }
        $res = null;
        $cmd = "docker ps -q -f name=$container";
        exec($cmd, $res);
        if ($res) {
            $this->error('Container is already running, doctane:stop the container first');

            return false;
        }
        // Check if container exists
        $this->line("$container stopped, restarting now...");
        $cmd = "docker ps -aq -f status=exited -f name=$container";
        exec($cmd, $res);
        if ($res) {
            passthru("docker start $container");
        } else {
            $this->info("$container not found, creating new container from $image");
            $cmd = "docker run -d --name $container -v ".getcwd().":/home/application -i -t -p $port:8000 $image";
            passthru($cmd);
        }
        $this->info('Container started, booting Octane server');
        passthru("docker exec -d $container php artisan octane:start --host=0.0.0.0 --workers=$workers --task-workers=$taskWorkers");

        $this->line('Checking octane server status');
        sleep(2);
        $cmd = "docker exec $container php artisan octane:status";
        $result = exec($cmd);
        if (Str::endsWith($result, 'Octane server is running.')) {
            $this->newLine();
            $this->info("Running on 127.0.0.1:$port");
        } else {
            $this->newLine();
            $this->error('Server is not running');
        }

        return true;
    }
}
