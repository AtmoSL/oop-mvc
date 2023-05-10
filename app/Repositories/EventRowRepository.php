<?php

namespace app\Repositories;

use app\Models\EventRow;

class EventRowRepository extends MainRepository
{
    /**
     * Получить класс модели
     * @return string
     */
    protected function getModelClass()
    {
        return EventRow::class;
    }

    /**
     * Получение минимальной цены для события
     * @param $eventId
     * @return mixed
     */
    public function getMinPriceForEvent($eventId){
        $row = $this
            ->startRequest()
            ->one(["event_id" => $eventId, "price" => "min"], ["price"])
            ->find();

        $price = $row->price;

        return $price;
    }

}