<?php

namespace app\Controllers\Admin;

use app\Repositories\TheaterRepository;
use vendor\Evd\Main\Viewer;

class TheaterAdminController extends MainAdminController
{
    private TheaterRepository $theaterRepository;

    public function __construct()
    {
        parent::__construct();
        $this->theaterRepository = new TheaterRepository();
    }

    public function index()
    {
        $theaters = $this->theaterRepository->getAllTheaters();

        Viewer::view("admin/theaters/allTheaters", compact("theaters"));
    }
}