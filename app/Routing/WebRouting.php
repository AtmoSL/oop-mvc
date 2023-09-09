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
    //Заказы
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

    //Жанры
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

    //Театры
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

    //Мероприятия
    "/admin/events" => [
        "controller" => "Admin\EventAdmin",
        "action" => "index",
    ],
    "/admin/events/new" => [
        "controller" => "Admin\EventAdmin",
        "action" => "createPage",
    ],
    "/admin/events/create" => [
        "controller" => "Admin\EventAdmin",
        "action" => "create",
        "method" => "POST"
    ],
    "/admin/event/edit" => [
        "controller" => "Admin\EventAdmin",
        "action" => "editPage",
        "method" => "GET",
    ],
    "/admin/event/editevent" => [
        "controller" => "Admin\EventAdmin",
        "action" => "edit",
        "method" => "POST",
    ],

    //Карусель фото мероприятия
    "/admin/event/photos/edit" => [
        "controller" => "Admin\EventPhotoAdmin",
        "action" => "editPage",
        "method" => "GET",
    ],
    "/admin/event/photos/addPhoto" => [
        "controller" => "Admin\EventPhotoAdmin",
        "action" => "addPhoto",
        "method" => "POST",
    ],
    "/admin/event/photos/deletePhoto" => [
        "controller" => "Admin\EventPhotoAdmin",
        "action" => "deletePhoto",
        "method" => "POST",
    ],

    //Ряды
    "/admin/event/rows/edit" => [
        "controller" => "Admin\EventRowAdmin",
        "action" => "editPage",
        "method" => "GET",
    ],
    "/admin/event/rows/create" => [
        "controller" => "Admin\EventRowAdmin",
        "action" => "create",
        "method" => "GET",
    ],
    "/admin/event/rows/edit/one" => [
        "controller" => "Admin\EventRowAdmin",
        "action" => "editOnePage",
        "method" => "GET",
    ],
    "/admin/event/rows/edit/one/changeprice" => [
        "controller" => "Admin\EventRowAdmin",
        "action" => "changePrice",
        "method" => "POST",
    ],
    "/admin/event/rows/edit/one/changeseats" => [
        "controller" => "Admin\EventRowAdmin",
        "action" => "changeSeats",
        "method" => "POST",
    ],
    "/admin/event/rows/edit/one/delete" => [
        "controller" => "Admin\EventRowAdmin",
        "action" => "deleteRow",
        "method" => "GET",
    ],

    //Администраторы
    "/admin/users" => [
        "controller" => "Admin\UserAdmin",
        "action" => "usersPage",
    ],
    "/admin/users/delete" => [
        "controller" => "Admin\UserAdmin",
        "action" => "deleteAdmin",
        "method" => "GET",
    ],

]);

$router->start();