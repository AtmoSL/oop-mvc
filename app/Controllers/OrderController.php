<?php

namespace app\Controllers;

use app\Repositories\EventRepository;
use app\Repositories\EventRowRepository;
use app\Repositories\EventSeatRepository;
use app\Repositories\OrderRepository;
use app\Repositories\OrderSeatRepository;
use app\Repositories\TheaterRepository;
use vendor\Evd\Main\Auth;
use vendor\Evd\Main\Viewer;

class OrderController
{

    private EventSeatRepository $eventSeatRepository;
    private TheaterRepository $theaterRepository;
    private EventRowRepository $eventRowRepository;
    private EventRepository $eventRepository;
    private OrderRepository $orderRepository;
    private OrderSeatRepository $orderSeatRepository;

    public function __construct()
    {
        $this->eventSeatRepository = new EventSeatRepository();
        $this->eventRowRepository = new EventRowRepository();
        $this->eventRepository = new EventRepository();
        $this->orderRepository = new OrderRepository();
        $this->orderSeatRepository = new OrderSeatRepository();
        $this->theaterRepository = new TheaterRepository();
    }

    /**
     * Создание заказа
     * @param $data
     * @return true|void
     */
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

        $eventDate = $this->eventRepository->getEventDateById($event_id);
        $actualDate = date("Y-m-d");

        if($actualDate > $eventDate){
            $_SESSION["orderMessages"][] = "Мероприятие уже прошло";
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        //Создание заказа
        $orderId = $this->orderRepository->createOrderAndGetId($event_id, $userId ,$totalPrice);
        //отмечаем, что места заняты после всех проверок
        foreach ($seatsId as $seatId){
            //Делаем место занятым
            $this->eventSeatRepository->setOccupied($seatId);
            $this->orderSeatRepository->createSeatOrder($seatId, $orderId);
        }

        header("Location: /order?id=$orderId");
        return true;
    }

    /**
     * Страница всех заказов
     * @return void
     */
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


    /**
     * Страница заказа
     * @param $data
     * @return void
     */
    public function userOrder($data)
    {
        if(empty($data["id"])){
            header("Location: /orders");
            die();
        }
        if(Auth::guest()){
            header("Location:/");
            die();
        }

        $orderId = $data["id"];
        $userId = Auth::userId();

        $order = $this->orderRepository->getOrderForOrderPage($orderId);

        if($userId != $order->user_id){
            header("Location:/");
            die();
        }

        $orderSeats = $this->orderSeatRepository->getSeatsForOrderPage($orderId);

        $seatsAndRows = [];

        //Формирование массива с местами в формате "Номер ряда" => "Номера мест"
        foreach ($orderSeats as $orderSeat){
            $newSeat = $this->eventSeatRepository->getSeatWithOrderById($orderSeat->seat_id);
            $seatsAndRows[$newSeat->row_num][] = $newSeat->num;
        }

        $order->theater_title = $this->theaterRepository->getTheaterTitle($order->theater_id);

        Viewer::view("userOrder", compact("order", "seatsAndRows"));
    }
}