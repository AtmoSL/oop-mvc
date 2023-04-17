<?php

namespace app\Controllers;

use app\Models\Theater;
use vendor\Evd\Main\Viewer;

class TheatersController
{
    public function index(){
        $theaters = Theater::all()->find();

        Viewer::view("theaters", compact("theaters"));
    }
}