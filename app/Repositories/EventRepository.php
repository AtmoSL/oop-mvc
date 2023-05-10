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

    public function getAllEvents(){
        $events = $this
            ->startRequest()
            ->all()
            ->with("genres", ["id as genre_id", "title as genre_title"])
            ->with("theaters", ["id as theater_id", "title as theater_title"])
            ->find();

        return $events;
    }

}