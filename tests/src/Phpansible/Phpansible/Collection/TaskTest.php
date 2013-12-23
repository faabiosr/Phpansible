<?php

namespace Phpansible\Phpansible\Collection;

use Phpansible\Phpansible\Entity\Task as TaskEntity;

class TaskTest extends \PHPUnit_Framework_TestCase
{
    private $collection;

    public function setUp()
    {
        parent::setUp();
        $this->collection = new Task();
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->collection = null;
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage $entity must be Task
     */
    public function testAttachShouldThrowExceptionWithInvalidParameter()
    {
        $this->collection->attach(new \stdClass());
    }

    public function testShouldAddEntityIntoCollection()
    {
        $this->collection->attach(new TaskEntity());
        $this->collection->attach(new TaskEntity());

        $this->assertCount(2, $this->collection);
    }

    public function testShouldRetrieveCollectionInArray()
    {
        $collection = new Task();
        $entity = array(
            'name'   => 'Install MySQL',
            'module' => array(
                'name'      => 'apt',
                'arguments' => array(
                    'pkg'   => 'mysql',
                    'state' => 'installed'
                )
            ),
            'notifiers' => array('start mysql')
        );

        $collection->attach(TaskEntity::createFromArray($entity));

        $expected = array($entity);

        $this->assertEquals($expected, $collection->toArray());
    }
}
