<?php

namespace Disk\Kernel;

class Router
{
    public static function start(): void
    {
        $controller = 'Index';
        $action = 'main';
        $params = null;
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $controller = $routes[1];
        }
        if (!empty($routes[2])) {
            $action = $routes[2];
        }
        if (!empty($routes[3])) {
            $params = $routes[3];
        }

        $controller = 'Disk\Controllers\\' . ucfirst(strtolower($controller)) . 'Controller';
        $action = strtolower($action) . 'Action';

        if (!class_exists($controller)) {
            echo 'Класс не найден';
            return;
        }
        if (!method_exists($controller, $action)) {
            echo 'Метод не найден';
            return;
        }

        $controller = new $controller();
        $controller->$action($params);
    }
}