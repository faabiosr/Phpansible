<?php

/**
 * IAction
 *
 * @abstract
 * @package Phpansible\Entity
 * @author Phpansible team
 */
abstract class IAction
{
    protected $name;

    protected $action;

    public function setName($name)
    {
        $this->name = $name;
    }

    public abstract function setAction($action);

    public function getOutput()
    {
        return "- name: example\n\tcommand: /some/path";
    }
}
