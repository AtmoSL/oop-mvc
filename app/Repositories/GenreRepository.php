<?php

namespace app\Repositories;

use app\Models\Genre;

class GenreRepository extends MainRepository
{
    /**
     * Получить класс модели
     * @return string
     */
    protected function getModelClass()
    {
        return Genre::class;
    }

    /**
     * Получить название жанра по id
     * @param $genreId
     * @return mixed
     */
    public function getGenreTitle($genreId)
    {
        $genre = $this->startRequest()
            ->one(["id" => $genreId], ["title"])
            ->find();

        return $genre->title;
    }

    /**
     * Получить все жанры для админки
     * @return mixed
     */
    public function getAllForAdmin()
    {
        $genres = $this
            ->startRequest()
            ->all()
            ->find();

        return $genres;
    }


    /**
     * Создание жанра
     * @param $title
     * @return void
     */
    public function createGenre($title)
    {
        $this->startRequest()
            ->create([
                    "title" => $title
                ]
            );
    }
}