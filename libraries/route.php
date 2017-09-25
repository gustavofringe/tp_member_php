<?php
class Route
{
    public $request
    /**
     * Route constructor.
     */
    public function __construct()
    { 
		$controller = $this->loadController();
		$action = $this->request->action;
		if($this->request->prefix){
			$action = $this->request->prefix.'_'.$action;
		}
		if(!in_array($action , array_diff(get_class_methods($controller),get_class_methods('Controller'))) ){
			$this->error('Le controller '.$this->request->controller.' n\'a pas de méthode '.$action); 
		}
		call_user_func_array(array($controller,$action),$this->request->params); 
        $controller->render($action);
        //
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
        //require ROOT.'/views/'.$url[0].'.php';
       //$controller->loadView($url[0]);
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
    function loadController(){
        $name = ucfirst($this->request->controller).'Controller'; 
        $file = ROOT.DS.'controller'.DS.$name.'.php';
        if(!file_exists($file)){
            $this->error('Le controller '.$this->request->controller.' n\'existe pas'); 
        } 
        require $file; 
        $controller = new $name($this->request); 
        return $controller;  
    }
}
