<?php

namespace app\Controllers\Admin;

use vendor\Evd\Main\Auth;

class MainAdminController
{
    public function __construct()
    {
        if(!Auth::isAdmin()){
            header("Location: /");
            die();
        }
    }
}