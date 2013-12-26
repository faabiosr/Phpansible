<?php

namespace Phpansible\Phpansible\Render;

use Twig_Environment;
use Twig_Loader_Array;

class TwigTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers Phpansible\Phpansible\Render\Twig::__construct
     */
    public function testConstructWithouArgument()
    {
        $twig = new Twig();
        $this->assertAttributeInstanceOf('Twig_Environment', 'twig', $twig);
    }

    /**
     * @covers Phpansible\Phpansible\Render\Twig::__construct
     */
    public function testConstructWithArgument()
    {
        $mockedTwigEnv = $this->getMock('Twig_Environment');
        $twig          = new Twig($mockedTwigEnv);

        $this->assertAttributeInstanceOf('Twig_Environment', 'twig', $twig);
        $this->assertInstanceOf('Phpansible\Phpansible\Render\Twig', $twig);
        $this->assertAttributeEquals($mockedTwigEnv, 'twig', $twig);
    }

    /**
     * @covers Phpansible\Phpansible\Render\Twig::__invoke
     */
    public function testRenderWithStringData()
    {
        $twig = new Twig();
        $data = 'Some string';

        $this->assertEquals($data, $twig($data));
    }

    /**
     * @covers Phpansible\Phpansible\Render\Twig::__invoke
     */
    public function testRenderWithNullData()
    {
        $twig = new Twig();
        $data = null;

        $this->assertNull($data, $twig($data));
    }

    /**
     * @covers Phpansible\Phpansible\Render\Twig::__invoke
     */
    public function testRenderWithIntegerData()
    {
        $twig = new Twig();
        $data = 10;

        $this->assertEquals($data, $twig($data));
    }

    /**
     * @covers Phpansible\Phpansible\Render\Twig::__invoke
     */
    public function testRenderWithArrayDataWithoutViewElement()
    {
        $data = array(
            'text' => 'Some text'
        );

        $twig = new Twig();

        $this->assertEquals($data, $twig($data));
    }

    /**
     * @covers Phpansible\Phpansible\Render\Twig::__invoke
     */
    public function testRenderWithIndexTemplate()
    {
        $templates = array(
            'index.html' => 'The O.S. name is {{ name }}.'
        );

        $expected = 'The O.S. name is Debian.';
        $twigLoader = new Twig_Loader_Array($templates);
        $twigEnv = new Twig_Environment($twigLoader);
        $twig = new Twig($twigEnv);
        $data = array(
            '_view' => 'index.html',
            'name'  => 'Debian'
        );

        $this->assertEquals($expected, $twig($data));
    }
}
