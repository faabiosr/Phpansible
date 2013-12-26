<?php

namespace Phpansible\Phpansible\Controller;

class IndexTest extends \PHPUnit_Framework_TestCase
{
    private $controller;

    public function setUp()
    {
        parent::setUp();
        $this->controller = new Index();
    }

    public function tearDown()
    {
        parent::tearDown();
        $this->controller = null;
    }

    /**
     * @covers Phpansible\Phpansible\Controller\Index::get
     */
    public function testGetRequestShouldRenderIndex()
    {
        $expected = array(
            '_view' => 'index/index.html'
        );

        $result = $this->controller->get();

        $this->assertEquals($expected, $result);
    }
}
