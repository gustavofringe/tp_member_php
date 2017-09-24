<?php
class Route
{
    /**
     * Route constructor.
     */
    public function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, "'");
        $url = explode("/", $url);
        $page = ROOT . '/controller/' . $url[0] . 'Controller.php';
        if (empty($url[0])) {
            require ROOT . '/controller/homeController.php';
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
        $controller = new $url[0];
        $controller->loadModel('user');
        if (isset($url[2])) {
            if(method_exists($controller, $url[1])) {
                $controller->{$url[1]}($url[2],$url[3]);
                die();
            }
        }
        if(isset($url[1]) && !file_exists($url[1])){
            require ROOT . '/views/404.php';
            die();
        }
        $controller->{$url[0]}();
    }
}
