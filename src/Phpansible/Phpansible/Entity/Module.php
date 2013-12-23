<?php

namespace Phpansible\Phpansible\Entity;

class Module implements EntityInterface
{
    private $name;
    private $arguments = array();

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        if (!is_string($name)) {
            throw new \InvalidArgumentException('$name must be string');
        }

        $this->name = $name;

        return $this;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function setArguments(array $args)
    {
        if (empty($args)) {
            throw new \UnexpectedValueException('Empty is not allowed');
        }

        $this->arguments = $args;

        return $this;
    }

    public function toArray()
    {
        $data = array(
            'name' => $this->getName(),
            'arguments' => $this->getArguments()
        );

        return $data;
    }

    public static function createFromArray(array $data)
    {
        if (!isset($data['name'])) {
            throw new \InvalidArgumentException('$data[name] must be required');
        }

        if (!isset($data['arguments'])) {
            throw new \InvalidArgumentException('$data[arguments] must be required');
        }

        $self = new self();
        $self->setName($data['name'])
            ->setArguments($data['arguments']);

        return $self;
    }
}
