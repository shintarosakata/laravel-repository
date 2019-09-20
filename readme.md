# Laravel-Repository

[![MIT License](http://img.shields.io/badge/license-MIT-blue.svg?style=flat)](LICENSE)
[![StyleCI](https://github.styleci.io/repos/209440408/shield?branch=master)](https://github.styleci.io/repos/209440408)
[![Latest Stable Version](https://poser.pugx.org/shintarosakata/laravel-repository/v/stable)](https://packagist.org/packages/shintarosakata/laravel-repository)

## About

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
$ artisan make:entity Sample
entity created successfully.

$ artisan make:repository Samples
repository created successfully.

$ artisan make:interface Samples
repository created successfully.

$ artisan make:repositoryProvider RepositoryProvider
Provider created successfully.
```

↓

```
.
└── app
    ├── Entities
    │   └── Sample.php
    │
    ├── Repositories
    │   ├── Samples.php
    │   └── SamplesInterface.php
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
        'Samples', // Add <name> here
    ];

    // ...
```

#### Register provider

./config/app.php

```./config/app.php
<?php

return [
    
    // ...
    
    'providers' => [
        // ...

        App\Providers\RepositoryProvider::class, // register provider
    ],
    
    // ...

];

```

### 3. Defining Repositories

```php
<?php

namespace App\Repositories\Samples;

use shintarosakata\LaravelRepository\Repository\Repository;
use Illuminate\Database\Eloquent\Collection;
use App\Entities\Sample;

class Samples extends Repository implements SamplesInterface
{
    protected $table = 'samples'; // Add DB Table name here
    
    public function fetchFirst(): Sample
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

namespace App\Repositories\Samples;

use shintarosakata\LaravelRepository\Repository\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Entities\Sample;

interface SamplesInterface extends RepositoryInterface
{
    // Add public functions here...
    
    public function fetchFirst(): Sample;

    public function fetchAll(): Collection;
}
```

### 5. Defining Entity

```php
<?php

namespace App\Entities;

use shintarosakata\LaravelRepository\Entity\Entity as upstreamEntity;

class Sample extends upstreamEntity
{
    // Add behavior here...
}
```

### 6. use!

```php
<?php

namespace App\Http\Controllers;

use App\Repositories\Samples\SamplesInterface;

class SampleController extends Controller
{
    private $samples_repository;

    // Dependency injection
    public function __construct(SamplesInterface $samples_repository) {
        $this->samples_repository = $samples_repository;
    }

    public function index()
    {
        $first_sample_entity = $this->samples_repository->fetchFirst();
        return view('sample.index', $first_sample_entity);
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
