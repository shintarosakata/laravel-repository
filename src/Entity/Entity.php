<?php

namespace shintarosakata\LaravelRepository\Entity;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

abstract class Entity extends Model
{
    public function getTable(): ?string
    {
        $repository_class = $this->getRepositoryClassName(get_class($this));
        if (class_exists($repository_class)) {
            return optional(new $repository_class)->getTable() ?? parent::getTable();
        }

        return  parent::getTable();


    }

    private function getRepositoryClassName(string $entity_class): string
    {
        $class_name_list = explode('\\', $entity_class);
        $class_name = Str::plural(last($class_name_list));
        $repository_class = 'App\Repositories\\'.$class_name.'\\'.$class_name;



        return $repository_class;
    }
}


