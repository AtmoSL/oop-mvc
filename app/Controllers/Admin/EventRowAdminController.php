<?php

namespace app\Controllers\Admin;

use app\Repositories\EventRowRepository;
use vendor\Evd\Main\Viewer;

class EventRowAdminController extends MainAdminController
{
    private EventRowRepository $eventRowRepository;
    public function __construct()
    {
        parent::__construct();
        $this->eventRowRepository = new EventRowRepository();
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
}