<?php

session_start();

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

ini_set ('display_errors', 1);

require_once ROOT.DS.'config.php';
require_once ROOT.DS.'utilities'.DS.'bootstrap.php';

function __autoload($class)
{
    if (file_exists(ROOT.DS.'utilities'.DS.strtolower($class).'.php'))
    {
        require_once ROOT.DS.'utilities'.DS.strtolower($class).'.php';
    }
    else if (file_exists(ROOT.DS.'models'.DS.strtolower($class).'.php'))
    {
        require_once ROOT.DS.'models'.DS.strtolower($class).'.php';
    }
    else if (file_exists(ROOT.DS.'controllers'.DS.strtolower($class).'.php'))
    {
        require_once ROOT.DS.'controllers' .DS.strtolower($class).'.php';
    }
}

die();

?>
