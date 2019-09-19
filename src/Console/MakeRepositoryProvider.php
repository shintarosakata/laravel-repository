<?php

namespace shintarosakata\LaravelRepository\Console;

use Illuminate\Console\GeneratorCommand as Command;

class MakeRepositoryProvider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repositoryProvider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repositoryProvider class';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $type = 'Provider';

    protected function getStub()
    {
        return __DIR__.'/stubs/provider.stub';
    }

    /**
     * クラスのデフォルトの名前空間を取得する
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Providers';
    }
}
