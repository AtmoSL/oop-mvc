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

        if (isset($row->price)) $price = $row->price;

        return $price;
    }

    /**
     * Получить все ряды события
     * @param $eventId
     * @return mixed
     */
    public function getRowsForEvent($eventId)
    {
        $rows = $this
            ->startRequest()
            ->where(["event_id" => $eventId])
            ->find();

        return $rows;
    }

    /**
     * Получение id мероприятия по id ряда
     * @param $seatRowId
     * @return mixed
     */
    public function getEventIdByRowId($seatRowId)
    {
        $row = $this
            ->startRequest()
            ->one(["id" => $seatRowId], ["event_id"])
            ->find();

        $eventId = $row->event_id;

        return $eventId;
    }

    /**
     * Получить стоимость ряда по id
     * @param $id
     * @return int
     */
    public function getPriceById($id): int
    {
        $row = $this
            ->startRequest()
            ->one(["id" => $id], ["price"])
            ->find();

        $price = $row->price;

        return $price;
    }

    public function createNewRow($eventId)
    {
        $maxRow = $this->startRequest()
            ->one(["event_id" => $eventId, "num" => "max"])
            ->find();

        $this->startRequest()
            ->create([
                "num" => $maxRow->num + 1,
                "event_id" => $eventId,
                "price" => 0
            ]);
    }

    public function getRowById($rowId)
    {
        $row = $this->startRequest()
            ->one(["id" => $rowId])
            ->find();

        return $row;
    }

    public function changePrice($rowId, $rowPrice)
    {
        $this->startRequest()
            ->where(["id" => $rowId])
            ->set(["price" => $rowPrice]);
    }

    public function deleteRow($rowId)
    {
        $this->startRequest()
            ->where(["id"=>$rowId])
            ->delete();
    }

}