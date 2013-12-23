<?php

namespace Phpansible\Phpansible\Entity;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
    private $entity;

    public function setUp()
    {
        parent::setUp();
        $this->entity = new Module();
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
    public function testShouldThrowExceptionWithInvalidName()
    {
        $this->entity->setName(10);
    }

    public function testSetAndGetName()
    {
        $name = 'apt';

        $this->entity->setName($name);
        $this->assertEquals($name, $this->entity->getName());
    }

    /**
     * @expectedException UnexpectedValueException
     * @expectedExceptionMessage Empty is not allowed
     */
    public function testShouldThrowExceptionWhenArgumentsParameterIsEmpty()
    {
        $this->entity->setArguments(array());
    }

    public function testSetAndGetArguments()
    {
        $args = array(
            'pkg'   => 'curl',
            'state' => 'installed'
        );

        $this->entity->setArguments($args);
        $this->assertEquals($args, $this->entity->getArguments());
    }

    public function testShouldRetrieveEntityInArray()
    {
        $entity = new Module();
        $entity->setName('apt')
            ->setArguments(array(
                'pkg'   => 'curl',
                'state' => 'installed'
            ));

        $expected = array(
            'name' => 'apt',
            'arguments' => array(
                'pkg'   => 'curl',
                'state' => 'installed'
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
            'arguments' => array(
                'pkg'   => 'curl',
                'state' => 'installed'
            )
        );

        $entity = Module::createFromArray($data);
    }


    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage $data[arguments] must be required
     */
    public function testCreateFromArrayShouldThrownExceptionWhenArgumentsNotExists()
    {
        $data = array(
            'name' => 'apt'
        );

        $entity = Module::createFromArray($data);
    }

    public function testShouldCreateEntityFromArray()
    {
        $data = array(
            'name'      => 'apt',
            'arguments' => array(
                'pkg'   => 'curl',
                'state' => 'installed'
            )
        );

        $entity = Module::createFromArray($data);

        $this->assertInstanceOf('Phpansible\Phpansible\Entity\Module', $entity);
        $this->assertEquals($data, $entity->toArray());
    }
}
