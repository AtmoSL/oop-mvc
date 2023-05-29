<?php

namespace app\Controllers\Admin;

use app\Repositories\EventRepository;
use app\Repositories\GenreRepository;
use app\Validators\GenreValidator;
use vendor\Evd\Main\Viewer;

class GenreAdminController extends MainAdminController
{
    private GenreRepository $genreRepository;
    private EventRepository $eventRepository;

    public function __construct()
    {
        parent::__construct();
        $this->genreRepository = new GenreRepository();
        $this->eventRepository = new EventRepository();
    }

    public function index()
    {
        $genres = $this->genreRepository->getAllForAdmin();

        Viewer::view("admin/genres/allGenres",compact("genres"));
    }

    public function createPage()
    {
        Viewer::view("admin/genres/createGenre");
    }

    public function create($data)
    {
        if (empty($data["title"])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $validator = new GenreValidator();
        $validation = $validator->validateAll($data);

        if (!$validation['isFullValidated']) {
            $_SESSION["genresMessages"] = $validation["fields"];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $this->genreRepository->createGenre($data["title"]);
        header('Location: /admin/genres');
        return true;
    }

    public function editPage($data)
    {
        if(empty($data["id"])){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $genreId = $data["id"];

        $genre = $this->genreRepository->getGenreByID($genreId);

        if(empty($genre->title)){
            header('Location: /admin/genres');
            die();
        }

        $genreTitle = $genre->title;

        Viewer::view("admin/genres/editGenre", compact("genreTitle", "genreId"));
    }

    public function edit($data)
    {
        if(empty($data["id"])){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $genreId = $data["id"];

        $genre = $this->genreRepository->getGenreByID($genreId);

        if(empty($genre->title)){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $validator = new GenreValidator();
        $validation = $validator->validateAll($data);

        if (!$validation['isFullValidated']) {
            $_SESSION["genresMessages"] = $validation["fields"];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $this->genreRepository->changeGenreTitle($genreId, $data["title"]);


        header('Location: /admin/genres');
        return true;
    }

    public function deletePage($data)
    {
        if(empty($data["id"])){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $genreId = $data["id"];

        $genre = $this->genreRepository->getGenreById($genreId);

        Viewer::view("admin/genres/deleteGenre", compact("genre"));
    }

    public function delete($data)
    {
        if(empty($data["id"])){
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $genreId = $data["id"];

        $this->eventRepository->allEventsDeleteGenre($genreId);
        $this->genreRepository->deleteGenre($genreId);

        header('Location: /admin/genres');
        return true;
    }
}