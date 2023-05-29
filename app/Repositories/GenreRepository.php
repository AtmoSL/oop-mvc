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

    /**
     * Получить жанр по id
     * @param $id
     * @return mixed
     */
    public function getGenreById($id)
    {
        $genre = $this
            ->startRequest()
            ->one(["id" => $id])
            ->find();

        return $genre;
    }

    /**
     * Изменить название жанра
     * @param $id
     * @param $title
     * @return true
     */
    public function changeGenreTitle($id, $title)
    {
        $this->startRequest()
        ->where(["id" => $id])
        ->set(["title"=>$title]);

        return true;
    }

    public function deleteGenre($genreId)
    {
        $this->startRequest()
            ->where(["id" => $genreId])
            ->delete();

        return true;
    }
}