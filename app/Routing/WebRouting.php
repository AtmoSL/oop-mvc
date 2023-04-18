<?php

use vendor\Evd\Main\Router;

$router = new Router();

$router->setRoutes([
    "/" => [
        "controller"  => "Index",
        "action"      => "index",
    ],
    "/theater-filter" => [
        "controller"  => "Index",
        "action"      => "theaterFilter",
        "method"      => "GET",
    ],
    "/genre-filter" => [
        "controller"  => "Index",
        "action"      => "genreFilter",
        "method"      => "GET",
    ],
    "/theaters" => [
        "controller"  => "Theaters",
        "action"      => "index",
    ],
    "/event" => [
        "controller"  => "Event",
        "action"      => "index",
    ],
]);

$router->start();