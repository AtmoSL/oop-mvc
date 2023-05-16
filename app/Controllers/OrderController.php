<?php

namespace app\Controllers;

use app\Repositories\EventRepository;
use app\Repositories\EventRowRepository;
use app\Repositories\EventSeatRepository;
use app\Repositories\OrderRepository;
use app\Repositories\OrderSeatRepository;
use vendor\Evd\Main\Auth;
use vendor\Evd\Main\Viewer;

class OrderController
{

    private EventSeatRepository $eventSeatRepository;
    private EventRowRepository $eventRowRepository;
    private OrderRepository $orderRepository;
    private OrderSeatRepository $orderSeatRepository;
    private EventRepository $eventRepository;

    public function __construct()
    {
        $this->eventSeatRepository = new EventSeatRepository();
        $this->eventRowRepository = new EventRowRepository();
        $this->orderRepository = new OrderRepository();
        $this->orderSeatRepository = new OrderSeatRepository();
        $this->eventRepository = new EventRepository();
    }

    public function create($data)
    {
        if(empty($data)){
            header("Location: /");
            die();
        }
        if(Auth::guest()){
            header("Location: /");
            die();
        }

        $event_id = $data["event_id"];
        unset($data["event_id"]);

        $seatsId = array_keys($data);
        $totalPrice = 0;

        $userId = Auth::userId();

        foreach ($seatsId as $seatId){
            //Проверка занятых мест
            $isOccupied = $this->eventSeatRepository->isOccupied($seatId);
            if($isOccupied){
                $_SESSION["orderMessages"][] = "Выбраны занятые места.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                die();
            }

            //Проверка того, что место соответствует мероприятию
            $seatRowId = $this->eventSeatRepository->getRowtIdBySeatId($seatId);
            $seatEventId = $this->eventRowRepository->getEventIdByRowId($seatRowId);

            if($event_id != $seatEventId){
                $_SESSION["orderMessages"][] = "Несоответствие места мероприятию.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                die();
            }

            $totalPrice += $this->eventRowRepository->getPriceById($seatRowId);
        }

        //Создание заказа
        $orderId = $this->orderRepository->createOrderAndGetId($event_id, $userId ,$totalPrice);

        foreach ($seatsId as $seatId){
            $this->orderSeatRepository->createSeatOrder($seatId, $orderId);
        }

        debug($orderId);
    }

    public function userOrders()
    {
        if(Auth::guest()){
            header("Location:/");
            die();
        }
        
        $userId = Auth::userId();

        $orders = $this->orderRepository->getOrderForUsersOrders($userId);

        foreach ($orders as &$order){
            $order->seats = $this->orderSeatRepository->getCountOfSeatsInOrder($order->id);
        }

        Viewer::view("userOrders", compact("orders"));
    }
}