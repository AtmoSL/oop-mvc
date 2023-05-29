<?php

namespace app\Controllers\Admin;

use app\Repositories\EventRepository;
use vendor\Evd\Main\Viewer;

class EventAdminController extends MainAdminController
{
    private EventRepository $eventRepository;
    public function __construct()
    {
        parent::__construct();
        $this->eventRepository = new EventRepository();
    }

    public function index()
    {
        $events = $this->eventRepository->getAllForAdmin();

        Viewer::view("admin/events/allEvents", compact("events"));
    }
}