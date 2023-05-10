<?php

namespace app\Controllers;

use app\Models\Event;
use app\Models\EventRow;
use app\Models\Genre;
use app\Models\Theater;
use app\Repositories\EventRepository;
use app\Repositories\EventRowRepository;
use vendor\Evd\DataBase\DB;
use vendor\Evd\Main\Viewer;

class IndexController
{
    protected EventRepository $eventRepository;
    protected EventRowRepository $eventRowRepository;
    public function __construct()
    {
        $this->eventRepository = new EventRepository();
        $this->eventRowRepository = new EventRowRepository();
    }

    /**
     * Главная страница с выводом всех мероприятий
     * @return void
     */
    public function index()
    {

        $events = $this->eventRepository->getAllEvents();

        foreach ($events as &$event){
            $event->price = $this->eventRowRepository->getMinPriceForEvent($event->id);
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

        $events = $this->eventRepository->getAllEventsTheaterFilter($data["id"]);

        if(!$events){
            header("location: /");
            die();
        }

        foreach ($events as &$event){
            $event->price = $this->eventRowRepository->getMinPriceForEvent($event->id);
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

        $events = $this->eventRepository->getAllEventsGenreFilter($data['id']);

        if(!$events){
            header("location: /");
            die();
        }

        foreach ($events as &$event){
            $event->price = $this->eventRowRepository->getMinPriceForEvent($event->id);
        }

        $theater = Genre::one(["id" => $data["id"]], ["title"])->find();

        $filterTitle = $theater->title;

        Viewer::view("index", compact("events", "filterTitle"));
    }
}