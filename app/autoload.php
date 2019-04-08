<?php
namespace blog\app;

class Autoloader {

    public static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($class) {
      $chemin = str_replace('\\','/',$class);
      require '../'.$chemin.'.php';
    }

}
