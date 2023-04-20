<?php

namespace app\Controllers;

use app\Models\Event;
use app\Models\EventPhotos;
use vendor\Evd\Main\Viewer;

class EventController
{

    /**
     * Страница мероприятия
     * @return void
     */
    public function index($data)
    {
        $id = $data["id"];
        $event = Event::one(["id"=>$id])
            ->with("genres", ["id as genre_id", "title as genre_title"])
            ->with("theaters", ["id as theater_id", "title as theater_title"])
            ->find();

        $carousel = EventPhotos::where(["event_id"=>$id], ["photo"])->find();
        if(!$carousel) $carousel = null;

        if(!$event) {
            http_response_code(404);
            Viewer::view('404');
        }

        Viewer::view("event", compact("event", "carousel"));
    }
}