<?php

use vendor\Evd\Main\Router;

$router = new Router();

$router->setRoutes([
    "/" => [
        "controller" => "Index",
        "action" => "index",
    ],
    "/theater-filter" => [
        "controller" => "Index",
        "action" => "theaterFilter",
        "method" => "GET",
    ],
    "/genre-filter" => [
        "controller" => "Index",
        "action" => "genreFilter",
        "method" => "GET",
    ],
    "/theaters" => [
        "controller" => "Theaters",
        "action" => "index",
    ],
    "/event" => [
        "controller" => "Event",
        "action" => "index",
        "method" => "GET",
    ],
    "/login" => [
        "controller" => "Login",
        "action" => "index",
    ],
    "/login/login" => [
        "controller" => "Login",
        "action" => "login",
        "method" => "POST",
    ],
    "/logout" => [
        "controller" => "Login",
        "action" => "logout",
    ],
    "/registration" => [
        "controller" => "Registration",
        "action" => "index",
    ],
    "/registration/register" => [
        "controller" => "Registration",
        "action" => "register",
        "method" => "POST",
    ],
    "/order/create" => [
        "controller" => "Order",
        "action" => "create",
        "method" => "POST",
    ],
    "/orders" => [
        "controller" => "Order",
        "action" => "userOrders",
    ],
    "/order" => [
        "controller" => "Order",
        "action" => "userOrder",
        "method" => "GET",
    ],
    "/order/cancel" => [
        "controller" => "Order",
        "action" => "canselOrder",
        "method" => "GET",
    ],

    //Админка
    "/admin" => [
        "controller" => "Admin\OrderAdmin",
        "action" => "index"
    ],
    "/admin/orders" => [
        "controller" => "Admin\OrderAdmin",
        "action" => "index"
    ],
    "/admin/order" => [
        "controller" => "Admin\OrderAdmin",
        "action" => "showOne",
        "method" => "GET",
    ],
    "/order/changestatus" => [
        "controller" => "Admin\OrderAdmin",
        "action" => "changeStatus",
        "method" => "POST",
    ],

    "/admin/genres" => [
        "controller" => "Admin\GenreAdmin",
        "action" => "index",
    ],
    "/admin/genre/create" => [
        "controller" => "Admin\GenreAdmin",
        "action" => "createPage",
    ],
    "/admin/genre/creategenre" => [
        "controller" => "Admin\GenreAdmin",
        "action" => "create",
        "method" => "POST",
    ],
    "/admin/genre/edit" => [
        "controller" => "Admin\GenreAdmin",
        "action" => "editPage",
        "method" => "GET",
    ],
    "/admin/genre/editgenre" => [
        "controller" => "Admin\GenreAdmin",
        "action" => "edit",
        "method" => "POST",
    ],
    "/admin/genre/delete" => [
        "controller" => "Admin\GenreAdmin",
        "action" => "deletePage",
        "method" => "GET",
    ],
    "/admin/genre/deletegenre" => [
        "controller" => "Admin\GenreAdmin",
        "action" => "delete",
        "method" => "POST",
    ],


    "/admin/theaters" => [
        "controller" => "Admin\TheaterAdmin",
        "action" => "index",
    ],
    "/admin/theater/create" => [
        "controller" => "Admin\TheaterAdmin",
        "action" => "createPage",
    ],
    "/admin/theater/createtheater" => [
        "controller" => "Admin\TheaterAdmin",
        "action" => "create",
        "method" => "POST",
    ],
    "/admin/theater/edit" => [
        "controller" => "Admin\TheaterAdmin",
        "action" => "editPage",
        "method" => "GET",
    ],
    "/admin/theater/edittheater" => [
        "controller" => "Admin\TheaterAdmin",
        "action" => "edit",
        "method" => "POST",
    ],
    "/admin/theater/delete" => [
        "controller" => "Admin\TheaterAdmin",
        "action" => "deletePage",
        "method" => "GET",
    ],
    "/admin/theater/deletetheater" => [
        "controller" => "Admin\TheaterAdmin",
        "action" => "delete",
        "method" => "POST",
    ],
]);

$router->start();