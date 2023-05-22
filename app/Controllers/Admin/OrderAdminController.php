<?php

namespace app\Controllers\Admin;

use app\Repositories\EventSeatRepository;
use app\Repositories\OrderRepository;
use app\Repositories\OrderSeatRepository;
use app\Repositories\OrderStatusRepository;
use app\Repositories\TheaterRepository;
use app\Repositories\UserRepository;
use vendor\Evd\Main\Viewer;

class OrderAdminController extends MainAdminController
{

    private OrderRepository $orderRepository;
    private EventSeatRepository $eventSeatRepository;
    private TheaterRepository $theaterRepository;
    private OrderSeatRepository $orderSeatRepository;
    private OrderStatusRepository $orderStatusRepository;
    private UserRepository $userRepository;


    public function __construct()
    {
        parent::__construct();
        $this->orderRepository = new OrderRepository();
        $this->eventSeatRepository = new EventSeatRepository();
        $this->orderSeatRepository = new OrderSeatRepository();
        $this->theaterRepository = new TheaterRepository();
        $this->orderStatusRepository = new OrderStatusRepository();
        $this->userRepository = new UserRepository();
    }

    public function allOrders()
    {

        $orders = $this->orderRepository->getAllOrdersForAdmin();

        foreach ($orders as &$order) {
            $order->seats = $this->orderSeatRepository->getCountOfSeatsInOrder($order->id);
        }

        Viewer::view("admin/allOrders", compact("orders"));
    }

    public function oneOrder($data)
    {
        if (empty($data["id"])) {
            header("Location /admin/orders");
            die();
        }

        $orderId = $data["id"];

        $order = $this->orderRepository->getAllOrderForAdmin($orderId);

        $orderSeats = $this->orderSeatRepository->getSeatsForOrderPage($orderId);
        $seatsAndRows = [];

        //Формирование массива с местами в формате "Номер ряда" => "Номера мест"
        foreach ($orderSeats as $orderSeat) {
            $newSeat = $this->eventSeatRepository->getSeatWithOrderById($orderSeat->seat_id);
            $seatsAndRows[$newSeat->row_num][] = $newSeat->num;
        }

        $order->theater_title = $this->theaterRepository->getTheaterTitle($order->theater_id);

        $statuses = $this->orderStatusRepository->getAllStatuses();

        $userInfo = $this->userRepository->getUserForOrderPage($order->user_id);

        Viewer::view("admin/order", compact("order", "seatsAndRows", "statuses", "userInfo"));
    }

    public function changeStatus($data)
    {
        if (empty($data)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $orderId = $data["order_id"];
        $statusId = $data["status_id"];

        if($statusId == 3){
            $orderSeats = $this->orderSeatRepository->getAllOrderSeats($orderId);
            foreach ($orderSeats as $orderSeat){
                $this->eventSeatRepository->unsetOccupied($orderSeat->event_seat_id);
            }
        }

        $this->orderRepository->changeOrderStatus($orderId,$statusId);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return true;
    }
}