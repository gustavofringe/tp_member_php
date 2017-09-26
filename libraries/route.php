<?php
class Route
{
    /**
     * Route constructor.
     */
    public function __construct()
    { 
		$controller = $this->loadController();
    }
    function loadController(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, "'");
        $url = explode("/", $url);
        if(isset($url[1])){
        $page = ROOT . '/controller/' . $url[0] . '/'.$url[1]. 'Controller.php';
        //dd($page);
        }
        if (empty($url[0])) {
            require_once ROOT . '/controller/homeController.php';
            $controller = new Home();
            $controller->home();
            die();
        }
        if (file_exists($page)) {
            require $page;
        }else {
            require ROOT . '/views/404.php';
            die();
        }
        $controller = new $url[1];
        $controller->loadModel('User');
        $controller->{$url[1]}();
        if (isset($url[2])) {
            if(method_exists($controller, $url[2])) {
                $controller->{$url[2]}($url[3],$url[4]);
                die();
            }
        }
        if(isset($url[2]) && !file_exists($url[2])){
            require ROOT . '/views/404.php';
            die();
        }
       
        return $controller;  
    }
}
