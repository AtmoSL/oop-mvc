<?php

namespace app\Controllers\Admin;

use app\Repositories\EventRepository;
use app\Repositories\TheaterRepository;
use app\Validators\TheaterValidator;
use vendor\Evd\Main\Viewer;

class TheaterAdminController extends MainAdminController
{
    private TheaterRepository $theaterRepository;
    private EventRepository $eventRepository;
    public function __construct()
    {
        parent::__construct();
        $this->theaterRepository = new TheaterRepository();
        $this->eventRepository = new EventRepository();
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


    public function editPage($data)
    {
        if(empty($data["id"])){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $theaterId = $data["id"];

        $theater = $this->theaterRepository->getTheaterById($theaterId);

        if(empty($theater->title)){
            header('Location: /admin/theaters');
            die();
        }

        $theaterTitle = $theater->title;

        Viewer::view("admin/theaters/editTheater", compact("theaterTitle", "theaterId"));
    }

    public function edit($data)
    {
        if(empty($data["id"])){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $theaterId = $data["id"];

        $theater = $this->theaterRepository->getTheaterById($theaterId);

        if(empty($theater->title)){
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

        $this->theaterRepository->changeTheaterTitle($theaterId, $data["title"]);


        header('Location: /admin/theaters');
        return true;
    }


    public function deletePage($data)
    {
        if(empty($data["id"])){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $theaterId = $data["id"];

        $theater = $this->theaterRepository->getTheaterById($theaterId);

        if(empty($theater->title)){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        Viewer::view("admin/theaters/deleteTheater", compact("theater"));
    }

    public function delete($data)
    {
        if(empty($data["id"])){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $theaterId = $data["id"];

        $this->eventRepository->allEventsDeleteTheater($theaterId);
        $this->theaterRepository->deleteTheater($theaterId);

        header('Location: /admin/theaters');
        return true;
    }
}