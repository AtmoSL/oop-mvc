<?php

namespace vendor\Evd\Main;

class Viewer
{
    static function view($view, $params = [])
    {
        extract($params);
        require_once "../views/" . $view . ".php";
    }
}