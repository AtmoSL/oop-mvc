<?php

namespace app\Controllers;

use vendor\Evd\Main\Viewer;

class RegistrationController
{
    public function index(){


        Viewer::view("registration");
    }
}