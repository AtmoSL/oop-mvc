<?php

namespace app\Controllers;

use vendor\Evd\Main\Viewer;

class IndexController
{
    public function index()
    {
        $events = [
            [
                "title" => "Бешенные деньги",
                "genre" => "комедия",
                "theater" =>
                    [
                        "title" => "Театр комедии им. Акимова",
                        "link" => "#",
                    ],
                "date" => "28.05",
                "count" => "25",
                "price" => "800"
            ],
            [
                "title" => "Без вины виноватые",
                "genre" => "комедия",
                "theater" =>
                    [
                        "title" => "Театр комедии им. Акимова",
                        "link" => "#",
                    ],
                "date" => "18.04",
                "count" => "15",
                "price" => "200"
            ],
            [
                "title" => "Мастер и Маргарита",
                "genre" => "мюзикл",
                "theater" =>
                    [
                        "title" => "ЛДМ. Новая-новая сцена",
                        "link" => "#",
                    ],
                "date" => "08.04",
                "count" => "19",
                "price" => "350"
            ],
            [
                "title" => "Приговор любви",
                "genre" => "Алеко",
                "theater" =>
                    [
                        "title" => "ЛДМ. Новая-новая сцена",
                        "link" => "#",
                    ],
                "date" => "30.04",
                "count" => "34",
                "price" => "450"
            ],
        ];

        Viewer::view("index", compact("events"));
    }
}