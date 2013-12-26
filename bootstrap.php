<?php

date_default_timezone_set('America/Sao_Paulo');

if (! defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

define('ROOT', realpath(__DIR__) . DS);
define('VENDOR', ROOT . DS . 'vendor');
define('VIEWS', ROOT . DS . 'views');

if (! file_exists($autoload = VENDOR . DS . 'autoload.php')) {
    throw new RuntimeException('Dependencies not installed.');
}

require $autoload;

unset($autoload);
