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
        "method"      => "GET",
    ],
    "/login" => [
        "controller"  => "Login",
        "action"      => "index",
    ],
    "/logout" => [
        "controller"  => "Login",
        "action"      => "logout",
    ],
    "/registration" => [
        "controller"  => "Registration",
        "action"      => "index",
    ],
    "/registration/register" => [
        "controller"  => "Registration",
        "action"      => "register",
        "method"      => "POST",
    ],
]);

$router->start();