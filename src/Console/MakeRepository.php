<?php

namespace shintarosakata\LaravelRepository\Console;

use Illuminate\Console\GeneratorCommand as Command;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $type = 'Repository';

    protected function getStub()
    {
        return __DIR__.'/stubs/repository.stub';
    }

    /**
     * クラスのデフォルトの名前空間を取得する
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories\\' . $this->getNameInput();
    }
}
