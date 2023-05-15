<?php

namespace app\Repositories;

use app\Models\Order;

class OrderRepository extends MainRepository
{
    protected function getModelClass()
    {
        return Order::class;
    }

    public function createOrderAndGetId($eventId, $userId, $totalPrice)
    {
        $this->startRequest()->create(
            [
                "event_id" => $eventId,
                "user_id" => $userId,
                "total_price" => $totalPrice,
            ]
        );

        $order = $this
            ->startRequest()
            ->where(["user_id"=>$userId, "event_id"=>$eventId], ["id"])
            ->orderDesc("id")
            ->limit("1")
            ->find();

        $orderId = $order[0]->id;

        return $orderId;
    }


}