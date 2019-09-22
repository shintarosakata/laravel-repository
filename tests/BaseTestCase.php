<?php

namespace shintarosakata\LaravelRepository\Tests;

use Orchestra\Testbench\TestCase;

class BaseTestCase extends TestCase
{
    protected function getPackageProviders($app)
    {
        return ['shintarosakata\LaravelRepository\ConsoleServiceProvider'];
    }
}
