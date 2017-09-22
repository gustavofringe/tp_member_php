<?php
class Route {
    public function __construct() {
        $url = $_GET['url'];
        $url = rtrim($url, "'");
        $url = explode("/", $url);
        $page = '../controller/'.$url[0].'Controller.php';
        if ($url[0] == false) {
            require ROOT.'/controller/homeController.php';
        }
        elseif(file_exists($page)) {
            require_once ROOT.'/controller/'.$url[0].'Controller.php';
        } else {
            require ROOT.'/views/404.php';
        }
    }
}
