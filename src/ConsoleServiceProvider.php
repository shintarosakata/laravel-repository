<?php

namespace shintarosakata\LaravelRepository;

use Illuminate\Support\ServiceProvider;
use shintarosakata\LaravelRepository\Console\MakeInterface;
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

        $this->app->singleton('command.shintaroakata.make.interface', function () {
            return new MakeInterface(new Filesystem);
        });

        $this->commands([
            'command.shintaroakata.make.repository',
            'command.shintaroakata.make.interface',
        ]);
    }

    public function provides()
    {
        return [
            'command.shintaroakata.make.repository',
            'command.shintaroakata.make.interface',
        ];
    }
}