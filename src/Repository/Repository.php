<?php

namespace shintarosakata\LaravelRepository\Repository;

use Illuminate\Support\Str;
use shintarosakata\LaravelRepository\Entity\Entity;

abstract class Repository implements RepositoryInterface
{
    /**
     * use table.
     * @var string
     */
    protected $table;

    /**
     * @var Entity
     */
    protected $builder;

    /**
     * Repository constructor.
     * @param null $entity
     * @throws \ReflectionException
     */
    public function __construct($entity = null)
    {
        if (is_null($entity)) {
            $entity = $this->searchEntity();
        }

        $this->setBuilder($entity->setTable($this->table));
    }

    /**
     * @return Entity
     * @throws \ReflectionException
     */
    public function newEntity(): Entity
    {
        return new $this->builder;
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
            return;
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
            return;
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
        $entity_class = 'App\Entities\\'.$class_name;

        return Str::singular($entity_class);
    }

    /**
     * @param string $class_name
     * @return Entity
     * @throws \ReflectionException
     */
    private function instantiateClass(string $class_name): Entity
    {
        $ref = new \ReflectionClass($class_name);

        return $ref->newInstance();
    }

    /**
     * @return Entity
     * @throws \ReflectionException
     */
    private function searchEntity(): Entity
    {
        $entity_class = $this->getEntityClassName(get_class($this));

        return $entity_instance = $this->instantiateClass($entity_class);
    }
}
