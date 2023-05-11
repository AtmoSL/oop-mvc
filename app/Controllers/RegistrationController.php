<?php

namespace app\Controllers;

use vendor\Evd\Main\Viewer;

class RegistrationController
{
    public function index(){
        Viewer::view("registration");
    }

    /**
     * Метод регистрации
     * @param $data
     * @return void
     */
    public function register($data){
        debug($data);
    }
}