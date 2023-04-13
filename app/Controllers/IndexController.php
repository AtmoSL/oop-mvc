<?php

namespace app\Controllers;

use vendor\Evd\Main\Viewer;

class IndexController
{
    public function index(){
        $message = "Главная страница";

        Viewer::view("index",compact("message"));
    }
}