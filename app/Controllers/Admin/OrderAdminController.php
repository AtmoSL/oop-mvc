<?php

namespace app\Controllers\Admin;

use app\Repositories\OrderRepository;
use app\Repositories\OrderSeatRepository;
use vendor\Evd\Main\Viewer;

class OrderAdminController extends MainAdminController
{

    private OrderRepository $orderRepository;
    private OrderSeatRepository $orderSeatRepository;

    public function __construct()
    {
        parent::__construct();
        $this->orderRepository = new OrderRepository();
        $this->orderSeatRepository = new OrderSeatRepository();
    }

    public function allOrders()
    {

        $orders = $this->orderRepository->getAllOrdersForAdmin();

        foreach ($orders as &$order){
            $order->seats = $this->orderSeatRepository->getCountOfSeatsInOrder($order->id);
        }

        Viewer::view("admin/allOrders", compact("orders"));
    }
}