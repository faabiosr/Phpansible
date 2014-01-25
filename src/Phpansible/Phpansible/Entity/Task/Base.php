<?php
/**
 * IAction
 *
 * @abstract
 * @package Phpansible\Entity\Task
 * @author Phpansible Team
 */

namespace Phpansible\Phpansible\Entity\Task;

class Base implements \IteratorAggregate
{
    /**
     * @var sring
     * @access protected
     */
    protected $name;

    /**
     * @var array
     * @access protected
     */
    protected $lines = array();

    /**
     * @param string $name
     * @access public
     * @return void
     */
    public function __construct($name)
    {
        $this->setName($name);
        $this->lines[0] = $this->getOutputName();
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->lines);
    }

    /**
     * @param string $name
     * @access public
     * @return void
     */
    public function setName($name)
    {
        if (! is_string($name)) {
            throw new InvalidArgumentException("\$name must be a string");
        }

        $this->name = $name;
    }

    /**
     * @access public
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    private function getOutputName()
    {
        return "- name: {$this->name}";
    }
}
