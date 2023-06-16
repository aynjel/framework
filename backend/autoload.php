<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('CORE', ROOT . DS . 'core');
define('MODEL', ROOT . DS . 'model');

// Load configuration and helper functions
function autoload($className){

    $classArray = explode('\\', $className);
    $class = end($classArray);

    if(file_exists(CORE . DS . $class . '.php')){
        require_once(CORE . DS . $class . '.php');
    }elseif(file_exists(MODEL . DS . $class . '.php')){
        require_once(MODEL . DS . $class . '.php');
    }else{
        die('Class ' . $class . ' not found!. Please check the class name.');
    }
}

spl_autoload_register('autoload');