<?php

namespace Phpansible\Phpansible\Collection;

use Phpansible\Phpansible\Entity\Task as TaskEntity;

class Task extends \SplObjectStorage implements CollectionInterface
{
    public function attach($entity)
    {
        if (!$entity instanceOf TaskEntity) {
            throw new \InvalidArgumentException('$entity must be Task');
        }

        parent::attach($entity);
    }

    public function toArray()
    {
        $collection = array();

        foreach ($this as $item) {
            array_push($collection, $item->toArray());
        }

        return $collection;
    }
}
