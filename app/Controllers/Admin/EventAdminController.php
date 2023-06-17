<?php

namespace app\Controllers\Admin;

use app\Repositories\EventPhotoRepository;
use app\Repositories\EventRepository;
use app\Repositories\EventRowRepository;
use app\Repositories\EventSeatRepository;
use app\Repositories\GenreRepository;
use app\Repositories\TheaterRepository;
use vendor\Evd\Main\Viewer;

class EventAdminController extends MainAdminController
{
    private EventRepository $eventRepository;
    private GenreRepository $genreRepository;
    private TheaterRepository $theaterRepository;
    private EventPhotoRepository $eventPhotoRepository;
    protected EventRowRepository $eventRowRepository;

    protected EventSeatRepository $eventSeatRepository;


    public function __construct()
    {
        parent::__construct();
        $this->eventRepository = new EventRepository();
        $this->genreRepository = new GenreRepository();
        $this->theaterRepository = new TheaterRepository();
        $this->eventPhotoRepository = new EventPhotoRepository();
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
        if(empty($data["id"])){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $eventId = $data["id"];

        $event = $this->eventRepository->getOneFullEvent($data["id"]);
        $genres = $this->genreRepository->getAllForAdmin();
        $theaters = $this->theaterRepository->getAllTheaters();
        $photos = $this->eventPhotoRepository->getPhotosForAdmin($eventId);
        $rows = $this->eventRowRepository->getRowsForEvent($eventId);

        foreach ($rows as &$row) {
            $row->seats = $this->eventSeatRepository->getSeatsForRow($row->id);
        }

        Viewer::view("admin/events/editEvent", compact("event", "genres", "theaters", "photos"));
    }
}