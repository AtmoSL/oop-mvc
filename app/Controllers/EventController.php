<?php

namespace app\Controllers;

use app\Models\EventPhotos;
use app\Models\EventRow;
use app\Models\EventSeat;
use app\Repositories\EventRepository;
use app\Repositories\EventRowRepository;
use vendor\Evd\Main\Viewer;

class EventController
{
    protected EventRepository $eventRepository;
    protected EventRowRepository $eventRowRepository;

    public function __construct()
    {
        $this->eventRepository = new EventRepository();
        $this->eventRowRepository = new EventRowRepository();
    }

    /**
     * Страница мероприятия
     * @return void
     */
    public function index($data)
    {
        $id = $data["id"];

        $event = $this->eventRepository->getOneFullEvent($id);

        if(!$event) {
            http_response_code(404);
            Viewer::view('404');
        }

        $carousel = EventPhotos::where(["event_id"=>$id], ["photo"])->find();
        if(!$carousel) $carousel = null;

        $rows = $this->eventRowRepository->getRowsForEvent($id);

        foreach ($rows as &$row) {
            $row->seats = EventSeat::where(["event_row_id"=>$row->id],["id","num","is_occupied"])->find();
        }


        Viewer::view("event", compact("event", "carousel", "rows"));
    }
}