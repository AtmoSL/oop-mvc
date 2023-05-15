<?php

namespace app\Models;

class Order extends \vendor\Evd\Main\Model
{
    protected static string $table = "orders";

    public $id;
    public $user_id;
    public $event_id;
}