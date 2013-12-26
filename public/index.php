<?php

require_once '../bootstrap.php';

use Respect\Config\Container;

$app = new Container(ROOT . 'config/app.ini');

$app->router->always('Accept', array(
    'text/html' => $app->twig
));

echo $app->router->run();
