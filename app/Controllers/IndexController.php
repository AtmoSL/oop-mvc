<?php

namespace app\Controllers;

use app\Models\Event;
use vendor\Evd\DataBase\DB;
use vendor\Evd\Main\Viewer;

class IndexController
{

    /**
     * Главная страница с выводом всех мероприятий
     * @return void
     */
    public function index()
    {
        $events = Event::all()
            ->with("genres", ["id as genre_id", "title as genre_title"])
            ->with("theaters", ["id as theater_id", "title as theater_title"])
            ->find();

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

        Viewer::view("index", compact("events"));
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

        Viewer::view("index", compact("events"));
    }
}