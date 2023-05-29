<?php

namespace app\Repositories;

use app\Models\Event;

class EventRepository extends MainRepository
{
    /**
     * Получить класс модели
     * @return string
     */
    protected function getModelClass()
    {
            return Event::class;
    }

    /**
     * Запрос всех событий без фильтров
     * @return mixed
     */
    public function getAllEvents(){
        $events = $this
            ->startRequest()
            ->all()
            ->with("genres", ["id as genre_id", "title as genre_title"])
            ->with("theaters", ["id as theater_id", "title as theater_title"])
            ->find();

        return $events;
    }

    /**
     * Вывод всех событий с фильтрацией по театру
     * @param $theaterId
     * @return mixed
     */
    public function getAllEventsTheaterFilter($theaterId){
        $events = $this
            ->startRequest()
            ->where(["theater_id"=>$theaterId])
            ->with("genres", ["id as genre_id", "title as genre_title"])
            ->with("theaters", ["id as theater_id", "title as theater_title"])
            ->find();

        return $events;
    }

    /**
     * Вывод всех событий с фильтрацией по жанру
     * @param $genreId
     * @return mixed
     */
    public function getAllEventsGenreFilter($genreId){
        $events = $this
            ->startRequest()
            ->where(["theater_id"=>$genreId])
            ->with("genres", ["id as genre_id", "title as genre_title"])
            ->with("theaters", ["id as theater_id", "title as theater_title"])
            ->find();

        return $events;
    }

    /**
     * Получение события по id
     * @param $eventId
     * @return mixed
     */
    public function getOneFullEvent($eventId)
    {
        $event = $this
            ->startRequest()
            ->one(["id"=>$eventId])
            ->with("genres", ["id as genre_id", "title as genre_title"])
            ->with("theaters", ["id as theater_id", "title as theater_title"])
            ->find();

        return $event;
    }


    public function getEventDateById($id)
    {
        $event = $this->startRequest()
        ->one(["id" => $id], ["date"])
        ->find();

        return $event->date;
    }

    public function allEventsDeleteGenre($genreId)
    {
        $this->startRequest()
            ->where(["genre_id" => $genreId])
            ->set(["genre_id" => 0]);

        return true;
    }

}