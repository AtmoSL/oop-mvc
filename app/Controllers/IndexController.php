<?php

namespace app\Controllers;

use app\Models\Event;
use app\Models\Genre;
use app\Models\Theater;
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
        $theater = Genre::one(["id" => $data["id"]], ["title"])->find();

        $filterTitle = $theater->title;

        Viewer::view("index", compact("events", "filterTitle"));
    }
}