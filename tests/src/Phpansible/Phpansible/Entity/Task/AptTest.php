<?php

use Phpansible\Phpansible\Entity\Task\Apt;

class AptTest extends PHPUnit_Framework_TestCase
{
    public function testSetPackages()
    {
        $expected = array(
            '- name: Packages',
            'sudo: yes',
            'apt: pkg={{ item }} state=latest',
            "with_items: ['php5-mysql','php5-cli','php5-imagick']"
        );

        $action = new Apt('Packages');
        $action->addPackage('php5-mysql');
        $action->addPackage('php5-cli');
        $action->addPackage('php5-imagick');

        $result = array();
        foreach ($action as $lines) {
            array_push($result, $lines);
        }

        $this->assertEquals($expected, $result);
    }
}
