<?php

namespace app\Models;

class EventRow extends \vendor\Evd\Main\Model
{
    public $id;
    public $num;
    public $event_id;
    public $price;

    protected static string $table = "event_rows";

}