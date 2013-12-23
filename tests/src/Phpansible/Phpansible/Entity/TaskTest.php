<?php

namespace Phpansible\Phpansible\Entity;

use Phpansible\Phpansible\Entity\Module as ModuleEntity;

class TaskTest extends \PHPUnit_Framework_TestCase
{
    private $entity;

    public function setUp()
    {
        parent::setUp();
        $this->entity = new Task();
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->entity = null;
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage $name must be string
     */
    public function testShouldThrownExceptionWhenNameIsInvalid()
    {
        $this->entity->setName(0015);
    }

    public function testShouldSetAndGetName()
    {
        $name = 'Installing Apache Server';

        $this->entity->setName($name);
        $this->assertEquals($name, $this->entity->getName());
    }

    public function testShouldSetAndGetModule()
    {
        $data = array(
            'name' => 'apt',
            'arguments' => array(
                'pkg'   => 'apache2',
                'state' => 'installed'
            )
        );

        $module = ModuleEntity::createFromArray($data);

        $this->entity->setModule($module);
        $this->assertEquals($module, $this->entity->getModule());
    }

    public function testShouldSetAndGetNotifications()
    {
        $notifiers = array(
            'stop apache',
            'start apache'
        );

        $this->entity->setNotifiers($notifiers);
        $this->assertEquals($notifiers, $this->entity->getNotifiers());
    }

    public function testShouldRetrieveEntityInArray()
    {
        $entity = new Task();
        $entity->setName('Installing Apache Server')
            ->setModule(new ModuleEntity())
            ->setNotifiers(array('stop apache', 'start apache'));

        $expected = array(
            'name'   => 'Installing Apache Server',
            'module' => array(
                'name'      => '',
                'arguments' => array()
            ),
            'notifiers' => array(
                'stop apache',
                'start apache'
            )
        );

        $this->assertEquals($expected, $entity->toArray());
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage $data[name] must be required
     */
    public function testCreateFromArrayShouldThrownExceptionWhenNameNotExists()
    {
        $data = array(
            'module' => array(
                'name' => 'apt'
            )
        );

        $entity = Task::createFromArray($data);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage $data[module] must be required
     */
    public function testCreateFromArrayShouldThrownExceptionWhenModuleNotExists()
    {
        $data = array(
            'name' => 'Installing Apache Server'
        );

        $entity = Task::createFromArray($data);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage $data[notifiers] must be required
     */
    public function testCreateFromArrayShouldThrownExceptionWhenNotifiersNotExists()
    {
        $data = array(
            'name' => 'Installing Apache Server',
            'module' => array()
        );

        $entity = Task::createFromArray($data);
    }

    public function testShouldCreateEntityFromArray()
    {
        $data = array(
            'name'   => 'Installing Apache Server',
            'module' => array(
                'name'      => 'apt',
                'arguments' => array(
                    'pkg' => 'apachee2',
                    'state' => 'installed'
                )
            ),
            'notifiers' => array(
                'stop apache',
                'start apache'
            )
        );

        $entity = Task::createFromArray($data);

        $this->assertInstanceOf('Phpansible\Phpansible\Entity\Task', $entity);
        $this->assertEquals($data, $entity->toArray());
    }
}
