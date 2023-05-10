<?php

namespace app\Controllers;

use app\Models\Event;
use app\Models\EventRow;
use app\Models\Genre;
use app\Models\Theater;
use app\Repositories\EventRepository;
use vendor\Evd\DataBase\DB;
use vendor\Evd\Main\Viewer;

class IndexController
{
    protected $eventRepository;
    public function __construct()
    {
        $this->eventRepository = new EventRepository();
    }

    /**
     * Главная страница с выводом всех мероприятий
     * @return void
     */
    public function index()
    {

        $events = $this->eventRepository->getAllEvents();

        foreach ($events as &$event){
            $event->price = 0;
            $event_row = EventRow::one(["event_id" => $event->id, "price" => "min"], ["price"])->find();
            if(isset($event_row->price)) $event->price = $event_row->price;
        }

        Viewer::view("index", compact("events"));
    }

    /**
     * Главная страница с выводом всех мероприятий (фильтрация по театрам)
     * @return void
     */
    public function theaterFilter($data)
    {
        if(!isset($data["id"])){
            header("location: /");
            die();
        }


        $events = Event::where(["theater_id"=>$data["id"]])
            ->with("genres", ["id as genre_id", "title as genre_title"])
            ->with("theaters", ["id as theater_id", "title as theater_title"])
            ->find();

        if(!$events){
            header("location: /");
            die();
        }

        foreach ($events as &$event){
            $event->price = 0;
            $event_row = EventRow::one(["event_id" => $event->id, "price" => "min"], ["price"])->find();
            if(isset($event_row->price)) $event->price = $event_row->price;
        }

        $theater = Theater::one(["id" => $data["id"]], ["title"])->find();

        $filterTitle = $theater->title;

        Viewer::view("index", compact("events", "filterTitle"));
    }

    /**
     * Главная страница с выводом всех мероприятий (фильтрация по жанрам)
     * @return void
     */
    public function genreFilter($data)
    {
        if(!isset($data["id"])){
            header("location: /");
            die();
        }

        $events = Event::where(["genre_id"=>$data["id"]])
            ->with("genres", ["id as genre_id", "title as genre_title"])
            ->with("theaters", ["id as theater_id", "title as theater_title"])
            ->find();

        if(!$events){
            header("location: /");
            die();
        }

        foreach ($events as &$event){
            $event->price = 0;
            $event_row = EventRow::one(["event_id" => $event->id, "price" => "min"], ["price"])->find();
            if(isset($event_row->price)) $event->price = $event_row->price;
        }

        $theater = Genre::one(["id" => $data["id"]], ["title"])->find();

        $filterTitle = $theater->title;

        Viewer::view("index", compact("events", "filterTitle"));
    }
}