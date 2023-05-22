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

    /**
     * Получение информации о заказе по id
     * @param $id
     * @return mixed
     */
    public function getOrderForOrderPage($id)
    {
        $order = $this
            ->startRequest()
            ->one(["id"=>$id])
            ->with("order_statuses", ["id as status_id", "title as status_title"])
            ->with("events", ["id as event_id", "title as event_title", "date as event_date", "theater_id as theater_id"])
            ->find();

        return $order;
    }

    public function getAllOrdersForAdmin()
    {
        $orders = $this
            ->startRequest()
            ->all(["id", "event_id", "total_price"])
            ->with("events", ["id as event_id", "title as event_title", "date as event_date"])
            ->with("users", ["id as user_id", "name as user_name"])
            ->find();

        return $orders;
    }

}