<?php
class Controller
{
    public function __construct() {
       //$this->file = ROOT."/views/".$controller.'/' . $action . ".php";
    }

    public function loadModel($name)
    {
        $path = ROOT.'/model/'.$name.'Model.php';
        if(file_exists($path)){
            require ROOT.'/model/'.$name.'Model.php';
            $modelName = 'User';
            $this->model = new $modelName();
        }
    }
}