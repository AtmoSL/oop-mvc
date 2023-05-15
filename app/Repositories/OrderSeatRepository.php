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

}