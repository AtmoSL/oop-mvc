<?php

namespace app\Repositories;

use app\Models\Theater;

class TheaterRepository extends MainRepository
{
    /**
     * Получить класс модели
     * @return string
     */
    protected function getModelClass()
    {
        return Theater::class;
    }

    /**
     * Получение названия театра по id
     * @param $theaterId
     * @return string
     */
    public function getTheaterTitle($theaterId)
    {
        $theater = $this
            ->startRequest()
            ->one(["id" => $theaterId], ["title"])
            ->find();

        return $theater->title;
    }

    /**
     * Получить список всех театров
     * @return mixed
     */
    public function getAllTheaters()
    {
        $theaters = $this
            ->startRequest()
            ->all()
            ->find();

        return $theaters;
    }

    /**
     * Создание театра
     * @param $title
     * @return void
     */
    public function createTheater($title)
    {
        $this->startRequest()
            ->create([
                    "title" => $title
                ]
            );
    }
}