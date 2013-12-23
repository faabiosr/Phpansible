<?php

namespace Phpansible\Phpansible\Entity;

class Task implements EntityInterface
{
    private $name;
    private $module;
    private $notifiers;

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

    public function getModule()
    {
        return $this->module;
    }

    public function setModule(Module $module)
    {
        $this->module = $module;
        return $this;
    }

    public function getNotifiers()
    {
        return $this->notifiers;
    }

    public function setNotifiers($notifiers)
    {
        $this->notifiers = $notifiers;
        return $this;

    }

    public function toArray()
    {
        $data = array(
            'name'      => $this->getName(),
            'module'    => $this->getModule()->toArray(),
            'notifiers' => $this->getNotifiers()
        );

        return $data;
    }

    public static function createFromArray(array $data)
    {
        if (!isset($data['name'])) {
            throw new \InvalidArgumentException('$data[name] must be required');
        }

        if (!isset($data['module'])) {
            throw new \InvalidArgumentException('$data[module] must be required');
        }
        
        if (!isset($data['notifiers'])) {
            throw new \InvalidArgumentException('$data[notifiers] must be required');
        }

        $self = new self();
        $self->setName($data['name'])
            ->setModule(Module::createFromArray($data['module']))
            ->setNotifiers($data['notifiers']);

        return $self;
    }
}
