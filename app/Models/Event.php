<?php

namespace app\Models;

/**
 * Модель мероприятия
 * @property $theater_title // при получении названия театра
 * @property $genre_title // При получении названия жанра
 */
/**
 * Модель мероприятия
 */
class Event extends \vendor\Evd\Main\Model
{
    public $title;
    public $id;
    public $genre_id;
    public $theater_id;
    public $date;
    public $count;
    protected static string $table = "events";

}