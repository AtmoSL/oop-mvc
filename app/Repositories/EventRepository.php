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
    public function getAllEvents()
    {
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
    public function getAllEventsTheaterFilter($theaterId)
    {
        $events = $this
            ->startRequest()
            ->where(["theater_id" => $theaterId])
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
    public function getAllEventsGenreFilter($genreId)
    {
        $events = $this
            ->startRequest()
            ->where(["theater_id" => $genreId])
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
            ->one(["id" => $eventId])
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

    /**
     * Удаление жанра у мероприятий
     * @param $genreId
     * @return true
     */
    public function allEventsDeleteGenre($genreId)
    {
        $this->startRequest()
            ->where(["genre_id" => $genreId])
            ->set(["genre_id" => 0]);

        return true;
    }

    /**
     * Удаление театра у мероприятий
     * @param $theaterId
     * @return true
     */
    public function allEventsDeleteTheater($theaterId)
    {
        $this->startRequest()
            ->where(["theater_id" => $theaterId])
            ->set(["theater_id" => 0]);

        return true;
    }

    /**
     * Получить все мероприятия для вывода в адмиинке
     * @return array
     */
    public function getAllForAdmin()
    {
        $events = $this
            ->startRequest()
            ->all(["id", "title", "date"])
            ->with("genres", ["id as genre_id", "title as genre_title"])
            ->with("theaters", ["id as theater_id", "title as theater_title"])
            ->find();

        return $events;
    }

    /**
     * Изменение данных о мероприятии адмиистратором
     *
     * @param $id
     * @param $title
     * @param $genre_id
     * @param $theater_id
     * @param $date
     * @param $is_published
     * @return true
     */
    public function editEventAdmin($id, $title, $genre_id, $theater_id, $date, $is_published)
    {
        $this->startRequest()
            ->where(["id" => $id])
            ->set([
                "title" => $title,
                "genre_id" => $genre_id,
                "theater_id" => $theater_id,
                "date" => $date,
                "is_published" => $is_published,
            ]);

        return true;
    }
}