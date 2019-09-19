<?php

namespace shintarosakata\LaravelRepository\RepositoryProvider;

use Illuminate\Support\ServiceProvider;

/**
 * リポジトリをバインドするクラス.
 *
 * Class RepositoryProvider
 */
class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->bindRepositories($this->repositories);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * @var array
     */
    protected $repositories = [];

    /**
     * Repositoryが置かれているpath
     * Where repositories are located.
     * @var string
     */
    protected $repositories_path = 'App\Repositories';

    /**
     * Register any Repositories.
     * @param  string[] $repositories
     * @return void
     */
    private function bindRepositories(array $repositories): void
    {
        foreach ($repositories as $repository) {
            $interface = $this->interfacePath($repository);

            $repository = $this->repositoryPath($repository);

            $this->app->bind($interface, $repository);
        }
    }

    private function interfacePath(string $repository): string
    {
        return $this->repositories_path."\\$repository\\$repository".'Interface';
    }

    private function repositoryPath(string $repository): string
    {
        return $this->repositories_path."\\$repository\\$repository";
    }
}
