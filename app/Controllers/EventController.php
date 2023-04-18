<?php

namespace app\Controllers;

use app\Models\Event;
use vendor\Evd\Main\Viewer;

class EventController
{

    /**
     * Страница мероприятия
     * @return void
     */
    public function index()
    {
        Viewer::view("event");
    }
}