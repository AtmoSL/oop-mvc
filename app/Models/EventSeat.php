<?php

namespace app\Models;

class EventSeat extends \vendor\Evd\Main\Model
{
    public $id;
    public $num;
    public $is_occupied;
    public $event_row_id;

    protected static string $table = "event_seats";
}