<?php

namespace shintarosakata\LaravelRepository;

use Illuminate\Support\ServiceProvider;
use shintarosakata\LaravelRepository\Console\MakeRepository;
use Illuminate\Filesystem\Filesystem;

class ConsoleServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        $this->registerCommands();
    }

    public function register()
    {
        // register bindings
    }

    protected function registerCommands()
    {
        $this->app->singleton('command.shintaroakata.make.repository', function () {
            return new MakeRepository(new Filesystem);
        });

        $this->commands([
            'command.shintaroakata.make.repository',
        ]);
    }

    public function provides()
    {
        return [
            'command.shintaroakata.make.repository',
        ];
    }
}