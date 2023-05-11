<?php

namespace app\Controllers;

use app\Models\Theater;
use app\Repositories\TheaterRepository;
use vendor\Evd\Main\Viewer;

class TheatersController
{
    protected TheaterRepository $theaterRepository;
    public function __construct()
    {
        $this->theaterRepository = new TheaterRepository();
    }

    public function index(){
        $theaters = $this->theaterRepository->getAllTheaters();

        Viewer::view("theaters", compact("theaters"));
    }
}