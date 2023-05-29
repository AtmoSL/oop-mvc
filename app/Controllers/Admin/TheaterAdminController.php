<?php

namespace app\Controllers\Admin;

use app\Repositories\TheaterRepository;
use app\Validators\TheaterValidator;
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


    public function createPage()
    {
        Viewer::view("admin/theaters/createTheater");
    }

    public function create($data)
    {
        if (empty($data["title"])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $validator = new TheaterValidator();
        $validation = $validator->validateAll($data);

        if (!$validation['isFullValidated']) {
            $_SESSION["theatersMessages"] = $validation["fields"];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $this->theaterRepository->createTheater($data["title"]);
        header('Location: /admin/theaters');
        return true;
    }
}