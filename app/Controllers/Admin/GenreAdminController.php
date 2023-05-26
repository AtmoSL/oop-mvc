<?php

namespace app\Controllers\Admin;

use app\Repositories\GenreRepository;
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
}