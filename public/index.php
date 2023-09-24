<?php 
require '../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


$router = new App\Router(dirname(__DIR__). '/views');

$router->match('/','rendu/index.php','rendu');
$router->get('/deconnection', 'admin/deconnection.php', 'deconnection');

$router->match('/admin/firstLogin','admin/firstLogin.php','firstLogin');
$router->match('/admin/createLog','admin/createLog.php','createLog');


$router->run();
?>