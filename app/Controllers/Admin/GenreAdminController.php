<?php

namespace app\Controllers\Admin;

use vendor\Evd\Main\Viewer;

class GenreAdminController extends MainAdminController
{
    public function index()
    {
        Viewer::view("admin/allGenres");
    }
}