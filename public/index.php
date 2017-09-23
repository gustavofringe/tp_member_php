<?php
define('WEBROOT',dirname(__FILE__));
define('ROOT',dirname(WEBROOT));
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
include ROOT.'/library/includes.php';

new Route();
//Autoloader::register();

?>