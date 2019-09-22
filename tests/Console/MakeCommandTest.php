<?php

namespace Tests\Console;

use Orchestra\Testbench\TestCase;
use Illuminate\Support\Facades\File;

class MakeCommandTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return ['shintarosakata\LaravelRepository\ConsoleServiceProvider'];
    }

    public function testMakeRepository()
    {
        $this->artisan('make:repository', [
            'name' => 'Samples',
        ])->expectsOutput('Repository created successfully.');
    }

    public function testExistsRepository()
    {
        $dir_path = app_path().'/Repositories';
        $file_path = $dir_path.'/Samples/Samples.php';
        $this->assertFileExists($file_path);
        File::deleteDirectory($dir_path);
    }

    public function testMakeInterface()
    {
        $this->artisan('make:interface', [
            'name' => 'Samples',
        ])->expectsOutput('Interface created successfully.');
    }

    public function testExistsInterface()
    {
        $dir_path = app_path().'/Repositories';
        $file_path = $dir_path.'/Samples/SamplesInterface.php';
        $this->assertFileExists($file_path);
        File::deleteDirectory($dir_path);
    }

    public function testMakeEntity()
    {
        $this->artisan('make:entity', [
            'name' => 'Sample',
        ])->expectsOutput('Entity created successfully.');
    }

    public function testExistsEntity()
    {
        $dir_path = app_path().'/Entities';
        $file_path = $dir_path.'/Sample.php';
        $this->assertFileExists($file_path);
        File::deleteDirectory($dir_path);
    }

    public function testMakeProvider()
    {
        $this->artisan('make:repositoryProvider', [
            'name' => 'RepositoryProvider',
        ])->expectsOutput('Provider created successfully.');
    }

    public function testExistsProvider()
    {
        $file_path = app_path().'/Providers/RepositoryProvider.php';
        $this->assertFileExists($file_path);
        File::delete($file_path);
    }
}
