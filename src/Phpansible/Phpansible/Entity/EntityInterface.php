<?php

namespace Phpansible\Phpansible\Entity;

interface EntityInterface
{
    public function toArray();

    public static function createFromArray(array $data);
}
