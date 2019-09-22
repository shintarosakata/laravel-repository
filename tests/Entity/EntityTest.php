<?php

namespace shintarosakata\LaravelRepository\Tests\Entity;

use ReflectionClass;
use shintarosakata\LaravelRepository\Entity\Entity;
use shintarosakata\LaravelRepository\Tests\BaseTestCase;

class EntityTest extends BaseTestCase
{
    /**
     * @var Entity
     */
    protected $test_entity;

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->test_entity = $this->getMockForAbstractClass(Entity::class);
    }

    /**
     * repositoryクラスが存在しない場合
     */
    public function testGetEntityClassName(): void
    {
        $this->test_entity->setTable('tests');

        $this->assertEquals('tests', $this->test_entity->getTable());
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetRepositoryClassName()
    {
        // approve private method
        $reflection = new ReflectionClass($this->test_entity);
        $getRepositoryClassName = $reflection->getMethod('getRepositoryClassName');

        $getRepositoryClassName->setAccessible(true);

        // exec method
        $result = $getRepositoryClassName->invoke($this->test_entity, 'ehgrga\argarg\srthst\person');
        $result2 = $getRepositoryClassName->invoke($this->test_entity, '\random\string\entity');
        $result3 = $getRepositoryClassName->invoke($this->test_entity, 'App\Entities\User');

        $this->assertEquals('App\Repositories\people\people', $result);
        $this->assertEquals('App\Repositories\entities\entities', $result2);
        $this->assertEquals('App\Repositories\Users\Users', $result3);

        echo $result;
    }
}
