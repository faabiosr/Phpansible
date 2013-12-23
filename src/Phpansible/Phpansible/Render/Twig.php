<?php

namespace Phpansible\Phpansible\Render;

use Twig_Environment;

class Twig
{
    /**
     * @var Twig_Environment
     */
    private $twig;

    public function __construct(Twig_Environment $twig = null)
    {
        if (!is_null($twig)) {
            return $this->twig = $twig;
        }

        $this->twig = new Twig_Environment();    
    }

    public function __invoke($data = null)
    {
        if (is_string($data)) {
            return $data;
        }

        if (is_null($data)) {
            return $data;
        }

        if (!is_array($data) || !isset($data['_view'])) {
            return $data;
        }

        $view = $data['_view'];
        unset($data['_view']);

        return $this->twig->render($view, $data);
    }
}
