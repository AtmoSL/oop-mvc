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
    "/login/login" => [
        "controller"  => "Login",
        "action"      => "login",
        "method"      => "POST",
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
    "/order/create" => [
        "controller"  => "Order",
        "action"      => "create",
        "method"      => "POST",
    ],
    "/orders" => [
        "controller"  => "Order",
        "action"      => "userOrders",
    ],
    "/order" => [
        "controller"  => "Order",
        "action"      => "userOrder",
        "method"      => "GET",
    ],
    "/order/cancel" => [
        "controller"  => "Order",
        "action"      => "canselOrder",
        "method"      => "GET",
    ],

    //Админка
    "/admin" =>  [
        "controller"  => "Admin\OrderAdmin",
        "action"      => "index"
    ],
    "/admin/orders" =>  [
        "controller"  => "Admin\OrderAdmin",
        "action"      => "index"
    ],
    "/admin/order" =>  [
        "controller"  => "Admin\OrderAdmin",
        "action"      => "showOne",
        "method"      => "GET",
    ],
    "/order/changestatus" => [
        "controller"  => "Admin\OrderAdmin",
        "action"      => "changeStatus",
        "method"      => "POST",
    ]
]);

$router->start();