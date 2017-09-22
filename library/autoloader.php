<?php
class Autoloader{
    public static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($class){
        require ROOT.'/model/' . $class . '.php';

        require ROOT.'/controller/' . $class . 'Controller.php';
        require ROOT.'/views/' . $class . '.php';
    }

}