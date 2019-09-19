<?php

namespace shintarosakata\LaravelRepository\Repository;

use shintarosakata\LaravelRepository\Entity\Entity;
use Illuminate\Support\Str;

abstract class Repository implements RepositoryInterface
{
    /**
     * use table
     * @var string
     */
    protected $table;

    /**
     * @var Entity
     */
    protected $builder;

    /**
     * AppRepository constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        $entity_class = $this->getEntityClassName(get_class($this));

        $entity_instance = $this->instantiateClass($entity_class);

        $entity_instance->setTable($this->table);

        $this->setBuilder($entity_instance);
    }

    /**
     * @return Entity
     * @throws \ReflectionException
     */
    public function newEntity(): Entity
    {
        $entity_class_name = $this->getEntityClassName(get_class($this));
        return $this->instantiateClass($entity_class_name);
    }

    /**
     * @param Entity $entity
     * @return Entity|null
     */
    public function save($entity)
    {
        if ($entity->save()) {
            return $entity;
        } else {
            return null;
        }
    }

    /**
     * @param Entity $entity
     * @param array $attributes
     * @param array $options
     * @return Entity|null
     */
    public function update($entity, array $attributes = [], array $options = [])
    {
        if ($entity->update($attributes, $options)) {
            return $entity;
        } else {
            return null;
        }
    }

    public function getTable(): ?string
    {
        return $this->table;
    }

    /**
     * @param Entity $entity
     */
    private function setBuilder(Entity $entity): void
    {
        $this->builder = $entity;
    }

    /**
     * @param  string example "App\Repositories\Features\Features"
     * @return string example "App\Entities\Feature"
     */
    private function getEntityClassName(string $repository_class): string
    {
        $class_name_list = explode('\\', $repository_class);
        $class_name = last($class_name_list);
        $entity_class = 'App\Entities\\' . $class_name;

        return $entity_class;
    }

    /**
     * @param string $class_name
     * @return Entity
     * @throws \ReflectionException
     */
    private function instantiateClass(string $class_name): Entity
    {
        $ref = new \ReflectionClass(Str::singular($class_name));

        return $ref->newInstance();
    }
}
