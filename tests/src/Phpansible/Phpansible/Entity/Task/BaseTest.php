<?php

use Phpansible\Phpansible\Entity\Task\Base;

class BaseTest extends PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $expected = array('- name: MyAction');

        $action = new Base('MyAction');

        $result = array();
        foreach ($action as $lines) {
            array_push($result, $lines);
        }

        $this->assertEquals($expected, $result);
    }
}
