<?php
/**
 * IAction
 *
 * @abstract
 * @package Phpansible\Entity\Task
 * @author Phpansible Team
 */

namespace Phpansible\Phpansible\Entity\Task;

abstract class Base
{
    protected $name;

    protected $action;

    /**
     * @param string $name
     * @access public
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return "- name: {$this->name}";
    }

    /**
     * @abstract
     * @param string $action
     * @access public
     * @return void
     */
    public abstract function setAction($action);

    /**
     * Must return commands for output file.
     *   return "- name: example\n\tcommand: /some/path";
     *
     * @abstract
     * @access public
     * @return string
     */
    public abstract function getOutput();
}
