<?php

namespace shintarosakata\LaravelRepository\Tests\Repository;

use shintarosakata\LaravelRepository\Entity\Entity;
use shintarosakata\LaravelRepository\Tests\BaseTestCase;
use ReflectionClass;

class RepositoryTest extends BaseTestCase
{
    /**
     * @var TestsRepository
     */
    protected $tests_repository;

    /**
     * @var Entity
     */
    protected $test_entity;

    protected $table_name;

    /**
     * initialize testsRepository with stubEntity
     *
     * @throws \ReflectionException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->test_entity = $this->createMock(Entity::class);

        $this->test_entity->method('setTable')
            ->willReturn($this->test_entity);

        $this->tests_repository = new TestsRepository($this->test_entity);
    }

    public function testGetTable(): void
    {
        $this->assertEquals('tests', $this->tests_repository->getTable());
    }

    public function testNewEntity(): void
    {
        $this->assertNotSame($this->test_entity, $this->tests_repository->newEntity());

        $this->assertEquals(get_class($this->test_entity) , get_class($this->tests_repository->newEntity()));
    }

    public function testGetEntityClassName(): void
    {
        // approve private method
        $reflection = new ReflectionClass($this->tests_repository);
        $getEntityClassName = $reflection->getMethod('getEntityClassName');

        $getEntityClassName->setAccessible(true);

        // exec method
        $result = $getEntityClassName->invoke($this->tests_repository, '98u5r98w5\vw8q8e5\Sample');
        $result2 = $getEntityClassName->invoke($this->tests_repository, '98u5r98w5\vwasgsth5968u88q\8e5\\Samples');
        $result3 = $getEntityClassName->invoke($this->tests_repository, 'Samples');

        $this->assertEquals('App\Entities\Sample', $result);
        $this->assertEquals('App\Entities\Sample', $result2);
        $this->assertEquals('App\Entities\Sample', $result3);
    }
}
