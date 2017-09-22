<?php
$url = $_GET['url'];
$url = rtrim($url,"'");
$url = explode("/", $url);
$page = '../controller/'.$url[0].'Controller.php';
if ($url[0]== false){
    require '../controller/homeController.php';
}
elseif(file_exists($page)){
    require '../controller/'.$url[0].'Controller.php';
}else{
    require '../views/404.php';
}