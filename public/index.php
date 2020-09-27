<?php

session_start();

function autoInclude($myclass)
{
    $myfile = '../' . str_replace('\\', '/', substr($myclass, 4)) . '.php';
    $myfile = realpath($myfile);
    include_once $myfile;
}

spl_autoload_register('autoInclude');

$route = new App\config\route_config;

if (isset($_GET['route']) && $route->routes[$_GET['route']]) {

    $controller = $route->routes[$_GET['route']]['controller'];
    $action = $route->routes[$_GET['route']]['action'];

    $class = "\\App\\Controller\\" . $controller;

    if (class_exists($class)) {
        $act = new $class();
    }

    if (method_exists($act, $action)) {
        $act->$action();
    }

} else {
    $liste = new App\Controller\TchatController();
    $liste->listMessage();
}
