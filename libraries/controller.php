<?php
class Controller
{

    public function __construct(){}

    public function loadModel($name)
    {
        $path = ROOT.'/model/'.$name.'Model.php';
        if(file_exists($path)){
            require ROOT.'/model/'.$name.'Model.php';
            $modelName = 'User';
            $this->model = new $modelName();
        }
    }
    public function loadView($views) {
        include ROOT.'/views/pages/'.$views.'.php';
    }
}