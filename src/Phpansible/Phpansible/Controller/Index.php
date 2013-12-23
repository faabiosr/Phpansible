<?php

namespace Phpansible\Phpansible\Controller;

use Respect\Rest\Routable;

class Index implements Routable
{
    public function get()
    {
        return array(
            '_view' => 'index/index.html'
        );
    }
}
