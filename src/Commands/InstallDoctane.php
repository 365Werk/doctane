<?php

namespace Werk365\Doctane\Commands;

use Illuminate\Console\Command;


class InstallDoctane extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'doctane:install';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Install the package, build an image and start the container';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info("Installing Doctane");
        $this->info("Publishing config to config/doctane.php");
        $this->call('vendor:publish', ['--tag' => 'doctane-config', '--force' => true]);

        $path = config_path('doctane') . '.php';

        $name = str_replace([' ', '.'], '-', strtolower($this->ask('What is your application name? (Will be used for image and container name)')));
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'doctane-container', $name.'-container', file_get_contents($path)
            ));
        }
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                'doctane-image', $name.'-image', file_get_contents($path)
            ));
        }

        $port = $this->ask('What port should your application run on?');
        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                '8000', $port, file_get_contents($path)
            ));
        }

        $w = $this->choice('Would you like to change the octane worker amounts?', ['no', 'yes']);
        if($w === 'yes'){
            $workers = $this->ask('How many workers do you want to use?');
            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    '"workers" => 4', '"workers" => '.trim($workers), file_get_contents($path)
                ));
            }
            $task_workers = $this->ask('How many task workers do you want to use?');
            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    '"task_workers" => 8', '"task_workers" => '.trim($task_workers), file_get_contents($path)
                ));
            }
        }

        $this->info('Finished configuration, you can edit these changes in config/doctane.php');
        $this->info('Starting to build image now');

        $container = config('doctane.container_name');;
        $image = config('doctane.image_name');
        $port = config('doctane.port');
        $boots = config('doctane.boot');

        $cmd = 'cd vendor/werk365/doctane/docker && docker build -t ' . $image . ' .';
        passthru($cmd);

        $this->info("Build complete");
        $this->info("To start the Octane server, run php artisan doctane:start");

    }
}
