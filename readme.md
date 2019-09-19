## About Laravel-Repository

framework for building repository pattern in Laravel.

## Requirements

requires Laravel 6.0

## Usage

### Installation

```
$ composer require shintarosakata/laravel-repository
```

### Artisan Commands

```
$ artisan make:repository <name>
$ artisan make:interface <name>
$ artisan make:entity <name>
$ artisan make:repositoryProvider <name>
```

RepositoryProvider is for binding repository and interface

## Quick start

### 1. make repository, interface, entity and provider

Entity name -> singular

Other -> plural

```
$ artisan make:entity Test
entity created successfully.

$ artisan make:repository Tests
repository created successfully.

$ artisan make:interface Tests
repository created successfully.

$ artisan make:repositoryProvider RepositoryProvider
Provider created successfully.
```

↓

```
.
└── app
    ├── Entities
    │   └── Test.php
    │
    ├── Repositories
    │   ├── Tests.php
    │   └── TestsInterface.php
    │
    └── Providers
        └── RepositoryProvider
```

### 2. Binding Interfaces To Implementations

```php
<?php

namespace App\Providers;

use shintarosakata\LaravelRepository\RepositoryProvider\RepositoryProvider as upstreamRepositoryProvider;

class RepositoryProvider extends upstreamRepositoryProvider
{
    // ...
    
    protected $repositories = [
        'Tests', // Add <name> here
    ];

    // ...
```

### 3. Defining Repositories

```php
<?php

namespace App\Repositories\Tests;

use shintarosakata\LaravelRepository\Repository\Repository;
use Illuminate\Database\Eloquent\Collection;
use App\Entities\Test;

class Tests extends Repository implements TestsInterface
{
    protected $table = ''; // Add DB Table name here
    
    public function fetchFirst(): Test
    {
        return $this->builder->first();
    }
    
    public function fetchAll(): Collection
    {
        return $this->builder->get();
    }
}

```

### 4. Defining Interface

```php
<?php

namespace App\Repositories\Tests;

use shintarosakata\LaravelRepository\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Entities\Test;

interface TestsInterface extends RepositoryInterface
{
    // Add public functions here...
    
    public function fetchFirst(): Test;

    public function fetchAll(): Collection;
}
```

### 5. Defining Entity

```php
<?php

namespace App\Entities;

use shintarosakata\LaravelRepository\Entity\Entity as upstreamEntity;

class Test extends upstreamEntity
{
    // Add behavior here...
}
```

### 6. use!

```php
<?php

namespace App\Http\Controllers;

use App\Repositories\Tests\TestsInterface;

class SampleController extends Controller
{
    private $tests_repository;

    // Dependency injection
    public function __construct(TestsInterface $tests_repository) {
        $this->tests_repository = $tests_repository;
    }

    public function index()
    {
        $first_test_entity = $this->tests_repository->fetchFirst();
        return view('sample.index', $first_test_entity);
    }
}

```

## Contributing

Thank you for considering contributing to the Laravel-Repository

please send an e-mail to Shintaro Sakata [shintaro.sakata@leverages.com](mailto:shintaro.sakata@leverages.com).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel-Repository, please send an e-mail to Shintaro Sakata [shintaro.sakata@leverages.com](mailto:shintaro.sakata@leverages.com). All security vulnerabilities will be promptly addressed.

## License

Laravel-Repository is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
