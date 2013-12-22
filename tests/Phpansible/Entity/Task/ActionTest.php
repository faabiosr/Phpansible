<?php

use Phpansible\Entity\Task\Action;

class ActionTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $expected = '- name: MyAction';

        $action = new Action();

        $action->setName('MyAction');

        $result = $action->getName();

        $this->assertEquals($expected, $result);
    }
}
