<?php

namespace Phpansible\Phpansible\Entity\Task;

class Apt extends Base {

    /**
     * @var array of strings
     * @access private
     */
    private $packages = array();

    /**
     * @param string $name
     * @access public
     * @return void
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->lines[1] = 'sudo: yes';
        $this->lines[2] = 'apt: pkg={{ item }} state=latest';
    }

    /**
     * @param string $package
     * @access public
     * @return void
     */
    public function addPackage($package)
    {
        if (! is_string($package)) {
            throw new InvalidArgumentException("\$package must be a string");
        }

        array_push($this->packages, "'{$package}'");
    }

    public function getIterator()
    {
        if (count($this->lines) > 3) {
            $this->lines = array_slice($this->items, 0, 3);
        }

        $this->lines[3] = $this->getOutputPackages();

        return parent::getIterator();
    }

    private function getOutputPackages()
    {
        return 'with_items: ['.implode(',', $this->packages).']';
    }
}
