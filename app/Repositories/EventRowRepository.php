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
    public function getMinPriceForEvent($eventId)
    {
        $price = 0;

        $row = $this
            ->startRequest()
            ->one(["event_id" => $eventId, "price" => "min"], ["price"])
            ->find();

        if(isset($row->price)) $price = $row->price;

        return $price;
    }

}