<?php

namespace vendor\Evd\Main;

class Router
{
    protected $routes =[];

    /**
     * Определение маршрута
     *
     * @return void
     */
    public function start()
    {
        $route = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)); // Определение пути

        if (isset($this->routes[$route])) {
            $controllerName = "app\\Controllers\\" . $this->routes[$route]["controller"] . "Controller";

            $action = $this->routes[$route]['action'];

            $controllerObject = new $controllerName();
            $controllerObject->$action();
        }
    }

    /**
     * Функция инициализации маршрутов
     *
     * @param $routes
     * @return void
     */
    public function setRoutes($routes = []){
        $this->routes = $routes;
    }
}