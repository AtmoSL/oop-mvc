<?php

namespace app\Controllers\Admin;

use app\Repositories\GenreRepository;
use app\Validators\GenreValidator;
use vendor\Evd\Main\Viewer;

class GenreAdminController extends MainAdminController
{
    private GenreRepository $genreRepository;

    public function __construct()
    {
        parent::__construct();
        $this->genreRepository = new GenreRepository();
    }

    public function index()
    {
        $genres = $this->genreRepository->getAllForAdmin();

        Viewer::view("admin/allGenres",compact("genres"));
    }

    public function createPage()
    {
        Viewer::view("admin/createGenre");
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
}