<?php

namespace app\Models;

use vendor\Evd\Main\Model;

class OrderSeat extends Model
{
    protected static string $table = "order_seats";

    public $id;
    public $order_id;
    public $event_seat_id;
}