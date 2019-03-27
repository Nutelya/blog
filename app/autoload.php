<?php
namespace blog\app;

class Autoloader {

    public static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($class){
      $nameSpace = explode('\\', $class);
      $i = count($nameSpace) - 1;
      $nameSpace[$i] = ucfirst($nameSpace[$i]);
      $class = implode('/', $nameSpace);
      require '../'.$class.'.php';
    }

}
