<?php

namespace shintarosakata\LaravelRepository\Console;

use Illuminate\Console\GeneratorCommand as Command;

class MakeEntity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:entity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new entity class';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $type = 'Entity';

    protected function getStub()
    {
        return __DIR__.'/stubs/entity.stub';
    }

    /**
     * クラスのデフォルトの名前空間を取得する.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Entities';
    }
}
