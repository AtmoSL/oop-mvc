<?php

use vendor\Evd\Main\Router;

$router = new Router();

$router->setRoutes([
    "/" => [
        "controller" => "Index",
        "action"     => "index",
    ],
]);

$router->start();