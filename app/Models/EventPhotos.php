<?php

namespace app\Models;

use vendor\Evd\Main\Model;

class EventPhotos extends Model
{
    public $id;
    public $event_id;
    public $photo;
    protected static string $table = "event_photos";

}