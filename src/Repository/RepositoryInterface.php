<?php

namespace shintarosakata\LaravelRepository\Repository;

use shintarosakata\LaravelRepository\Entity\Entity;

interface RepositoryInterface
{
    public function newEntity(): Entity;

    public function save($entity);

    public function update($entity, array $attributes = [], array $options = []);

    public function getTable(): ?string;
}
