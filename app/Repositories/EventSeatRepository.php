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
            ->where(["event_row_id" => $rowId], ["id", "num", "is_occupied"])
            ->orderDesc("id")
            ->find();

        return $seats;
    }

    /**
     * Проверка занятых мест
     * @param $seatId
     * @return bool
     */
    public function isOccupied($seatId):bool
    {
        $seat = $this
            ->startRequest()
            ->one(["id" => $seatId], ["is_occupied"])
            ->find();

        $isOccupied = $seat->is_occupied;

        return $isOccupied;
    }

    /**
     * Получение id ряда по id места
     * @param $seatId
     * @return mixed
     */
    public function getRowtIdBySeatId($seatId)
    {
        $seat = $this
            ->startRequest()
            ->one(["id" => $seatId], ["event_row_id"])
            ->find();

        $rowId = $seat->event_row_id;

        return $rowId;
    }

    /**
     * Получение ряд по id места
     * @param $seatId
     * @return mixed
     */
    public function getSeatWithOrderById($seatId)
    {
        $seat = $this
            ->startRequest()
            ->one(["id" => $seatId], ["id", "num"])
            ->with("event_rows", ["num as row_num"])
            ->find();

        return $seat;
    }

    /**
     * Отметить, что место занято
     * @param $id
     * @return mixed
     */
    public function setOccupied($id)
    {
        $result = $this->startRequest()
            ->where(["id" => "$id"])
            ->set(["is_occupied"=>"1"]);

        return true;
    }

    /**
     * Отметить, что место не занято
     * @param $id
     * @return mixed
     */
    public function unsetOccupied($id)
    {
        $result = $this->startRequest()
            ->where(["id" => "$id"])
            ->set(["is_occupied"=>"0"]);

        return true;
    }

    /**
     * Получить количество мест в ряду
     * @param $rowId
     * @return int
     */
    public function getSeatsCountForRow($rowId)
    {
        $seats = $this
            ->startRequest()
            ->where(["event_row_id" => $rowId], ["id", "num", "is_occupied"])
            ->orderDesc("id")
            ->find();

        return count($seats);
    }

    /**
     * Добавить место
     * @param $rowId
     * @param $seatNum
     * @return void
     */
    public function addSeat($rowId, $seatNum)
    {
        $this->startRequest()
            ->create([
                "event_row_id" => $rowId,
                "num" => $seatNum,
                "is_occupied" => 0,
            ]);
    }

    public function getMaxSeatNum($rowId)
    {
        $seat = $this->startRequest()
            ->one(["event_row_id" => $rowId], ["num"])
            ->orderDesc("id")
            ->limit(1)
            ->find();

        return (isset($seat->num)) ? $seat->num : 0;
    }

    public function deleteLastInRow($rowId)
    {
        $seat = $this->startRequest()
            ->one(["event_row_id" => $rowId], ["id"])
            ->orderDesc("id")
            ->limit(1)
            ->find();


        $this->startRequest()
            ->where(["id"=>$seat->id])
            ->delete();
    }
}