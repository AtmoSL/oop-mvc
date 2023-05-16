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

    /**
     * Получить список заказов для страницы заказов пользователя
     * @param $userId
     * @return mixed
     */
    public function getOrderForUsersOrders($userId)
    {
        $orders = $this
            ->startRequest()
            ->where(["user_id"=>$userId], ["id", "event_id", "total_price"])
            ->with("events", ["id as event_id", "title as event_title", "date as event_date"])
            ->find();

        return $orders;
    }

}