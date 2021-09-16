<?php

namespace Werk365\Doctane;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class DoctaneServiceProvider extends ServiceProvider
{
    /**
     * The console commands.
     *
     * @var bool
     */
    protected $commands = [
        'Werk365\Doctane\Commands\InstallDoctane',
        'Werk365\Doctane\Commands\DoctaneNpm',
        'Werk365\Doctane\Commands\DoctaneComposer',
        'Werk365\Doctane\Commands\DoctaneBash',
        'Werk365\Doctane\Commands\StartDocker',
        'Werk365\Doctane\Commands\RestartDocker',
        'Werk365\Doctane\Commands\StopDocker',
        'Werk365\Doctane\Commands\ReloadDocker',
        'Werk365\Doctane\Commands\DockerStatus',
    ];

    /**
     * Bootstrap the application events.
     *
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/doctane.php' => config_path('doctane.php'), 'doctane-config',
        ]);
    }

    /**
     * Register the command.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/doctane.php', 'doctane');

        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
            $this->publishes([
                __DIR__.'/../config/doctane.php' => config_path('doctane.php'),
            ], 'doctane-config');
        }
    }
}
