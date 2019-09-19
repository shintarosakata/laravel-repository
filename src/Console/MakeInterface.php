<?php

namespace shintarosakata\LaravelRepository\Console;

use Illuminate\Console\GeneratorCommand as Command;

class MakeInterface extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:interface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new interface class';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $type = 'Interface';

    protected function getStub()
    {
        return __DIR__.'/stubs/interface.stub';
    }

    /**
     * クラスのデフォルトの名前空間を取得する
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories\\' . trim($this->argument('name'));
    }

    /**
     * クラス名の偽装
     *
     * @return string
     */
    protected function getNameInput()
    {
        return trim($this->argument('name')) . 'Interface';
    }
}
