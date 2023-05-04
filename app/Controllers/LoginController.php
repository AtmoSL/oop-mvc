<?php

namespace app\Controllers;

use vendor\Evd\Main\Viewer;

class LoginController
{
    public function index(){


        Viewer::view("login");
    }
}