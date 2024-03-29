<?php

namespace app\Controllers\Admin;

use app\Repositories\EventPhotoRepository;
use app\Repositories\EventRepository;
use app\Repositories\EventRowRepository;
use app\Repositories\EventSeatRepository;
use app\Repositories\GenreRepository;
use app\Repositories\TheaterRepository;
use app\Validators\EventValidator;
use vendor\Evd\Main\Viewer;

class EventAdminController extends MainAdminController
{
    private EventRepository $eventRepository;
    private GenreRepository $genreRepository;
    private TheaterRepository $theaterRepository;
    protected EventRowRepository $eventRowRepository;

    protected EventSeatRepository $eventSeatRepository;


    public function __construct()
    {
        parent::__construct();
        $this->eventRepository = new EventRepository();
        $this->genreRepository = new GenreRepository();
        $this->theaterRepository = new TheaterRepository();
        $this->eventRowRepository = new EventRowRepository();
        $this->eventSeatRepository = new EventSeatRepository();
    }

    public function index()
    {
        $events = $this->eventRepository->getAllForAdmin();

        Viewer::view("admin/events/allEvents", compact("events"));
    }

    public function editPage($data)
    {
        if (empty($data["id"])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $eventId = $data["id"];

        $event = $this->eventRepository->getOneFullEvent($data["id"]);
        $genres = $this->genreRepository->getAllForAdmin();
        $theaters = $this->theaterRepository->getAllTheaters();
        $rows = $this->eventRowRepository->getRowsForEvent($eventId);

        foreach ($rows as &$row) {
            $row->seats = $this->eventSeatRepository->getSeatsForRow($row->id);
        }

        Viewer::view("admin/events/editEvent", compact("event", "genres", "theaters"));
    }

    public function edit($data)
    {
        if (empty($data)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $id = $data["id"];
        unset($data["id"]);

        if($data["is_published"] == null) $data["is_published"] = 0;

        $validator = new EventValidator();
        $validation = $validator->validateAll($data);

        if (!$validation['isFullValidated']) {
            $_SESSION["editEventMessages"] = $validation["fields"];
        } else {
            $this->eventRepository->editEventAdmin($id,
                $data["title"],
                $data["genre_id"],
                $data["theater_id"],
                $data["date"],
                $data["is_published"]);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function createPage()
    {

        $genres = $this->genreRepository->getAllForAdmin();
        $theaters = $this->theaterRepository->getAllTheaters();

        Viewer::view("admin/events/createEvent", compact("genres", "theaters"));
    }

    public function create($data)
    {
        if (empty($data)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $validator = new EventValidator();
        $validation = $validator->validateAll($data);

        if (!$validation['isFullValidated']) {
            $_SESSION["createEventMessages"] = $validation["fields"];
            header('Location: ' . $_SERVER['HTTP_REFERER']);

        } else {
            $eventId = $this->eventRepository->createEventAndGetId(
                $data["title"],
                $data["genre_id"],
                $data["theater_id"],
                $data["date"],
                $data["is_published"]
            );

            $eventDir = "img/events/'.$eventId";

            mkdir($uploadDir, 0777, true);

            header("Location:/admin/event/edit?id=$eventId");
        }

        return true;
    }
}