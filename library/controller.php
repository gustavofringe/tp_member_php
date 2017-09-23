<?php
class Controller
{
    public function __construct()
    {
        //$this->view = new View();
    }

    public function loadModel($name)
    {
        $path = ROOT.'/model/'.$name.'Model.php';
        if(file_exists($path)){
            require ROOT.'/model/'.$name.'Model.php';
        }
    }
    public function require_view($view){
        include ROOT.'/views/'.$view.'.php';
    }
}