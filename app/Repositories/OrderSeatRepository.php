<?php

namespace app\Repositories;

use app\Models\OrderSeat;

class OrderSeatRepository extends MainRepository
{
    protected function getModelClass()
    {
        return OrderSeat::class;
    }

    /**
     * Создать запись
     * @param $seatId
     * @param $orderId
     * @return void
     */
    public function createSeatOrder($seatId, $orderId)
    {
        $this->startRequest()->create(
            [
                "event_seat_id" => $seatId,
                "order_id" => $orderId,
            ]
        );
    }

    /**
     * Получение количества мест в заказе
     * @param $orderid
     * @return int
     */
    public function getCountOfSeatsInOrder($orderId)
    {
        $seats = $this->startRequest()
            ->where(["order_id" => $orderId], ["id"])
            ->find();

        $countOfSeats = count($seats);

        return $countOfSeats;
    }

    /**
     * Получить список мест для страницы заказа
     * @param $orderId
     * @return mixed
     */
    public function getSeatsForOrderPage($orderId)
    {
        $seats = $this->startRequest()
            ->where(["order_id" => $orderId], ["id"])
            ->with("event_seats", ["id as seat_id"])
            ->find();

        return $seats;
    }

}