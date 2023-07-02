<?php

namespace app\Controllers\Admin;

use app\Repositories\EventRepository;
use app\Repositories\EventRowRepository;
use app\Repositories\EventSeatRepository;
use app\Validators\EventRowValidator;
use vendor\Evd\Main\Viewer;

class EventRowAdminController extends MainAdminController
{
    private EventRowRepository $eventRowRepository;
    private EventSeatRepository $eventSeatRepository;
    private EventRepository $eventRepository;
    public function __construct()
    {
        parent::__construct();
        $this->eventRowRepository = new EventRowRepository();
        $this->eventSeatRepository = new EventSeatRepository();
        $this->eventRepository = new EventRepository();
    }
    public function editPage($data)
    {
        if (empty($data["id"])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $eventId = $data["id"];
        $rows = $this->eventRowRepository->getRowsForEvent($eventId);

        Viewer::view("admin/events/rows/edit", compact("rows", "eventId"));
    }

    public function create($data)
    {
        if (empty($data["id"])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $eventId = $data["id"];

        $this->eventRowRepository->createNewRow($eventId);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return true;
    }

    public function editOnePage($data)
    {
        if (empty($data["id"])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $rowId = $data["id"];
        $row = $this->eventRowRepository->getRowById($rowId);

        $seatsCount = $this->eventSeatRepository->getSeatsCountForRow($rowId);

        $eventTitle = $this->eventRepository->getEventTitleById($row->event_id);

        Viewer::view("admin/events/rows/editOne", compact("row", "seatsCount", "eventTitle"));
    }

    public function changePrice($data)
    {
        if (empty($data["id"]) || empty($data["price"])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $rowId = $data["id"];
        $rowPrice = $data["price"];

        $validator = new EventRowValidator();

        $validation = $validator->validateAll(["price" => $rowPrice]);

        if (!$validation['isFullValidated']) {
            $_SESSION["eventRowMessages"] = $validation["fields"];
        } else {
            $this->eventRowRepository->changePrice($rowId, $rowPrice);
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);

        return true;
    }
}