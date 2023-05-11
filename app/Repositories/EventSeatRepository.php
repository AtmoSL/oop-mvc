<?php

namespace app\Repositories;

use app\Models\EventSeat;

class EventSeatRepository extends MainRepository
{
    /**
     * Получить класс модели
     * @return string
     */
    protected function getModelClass()
    {
        return EventSeat::class;
    }

    /**
     * Получить места в ряду
     * @param $rowId
     * @return mixed
     */
    public function getSeatsForRow($rowId)
    {
        $seats = $this
            ->startRequest()
            ->where(["event_row_id"=>$rowId],["id","num","is_occupied"])
            ->find();

        return $seats;
    }
}