<?php

namespace app\Controllers;

use vendor\Evd\Main\Auth;
use vendor\Evd\Main\Viewer;

class LoginController
{
    public function index(){
        Viewer::view("login");
    }

    /**
     * Выход из аккаунта
     * @return void
     */
    public function logout()
    {
        Auth::logout();
        header("Location: /");
    }
}