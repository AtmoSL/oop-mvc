<?php

namespace vendor\Evd\Main;

class Router
{
    protected $routes = [];

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
            $method = (isset($this->routes[$route]['method'])) ? $this->routes[$route]['method'] : "";

            $controllerObject = new $controllerName();

            switch ($method) {
                case "GET":
                    $controllerObject->$action($_GET);
                    break;
                case "POST":
                    $controllerObject->$action($_POST);
                    break;
                default:
                    $controllerObject->$action();
            }
        } else {
            http_response_code(404);
            Viewer::view('404');
        }
    }

    /**
     * Функция инициализации маршрутов
     *
     * @param $routes
     * @return void
     */
    public function setRoutes($routes = [])
    {
        $this->routes = $routes;
    }
}