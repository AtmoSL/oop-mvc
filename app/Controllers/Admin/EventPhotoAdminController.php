<?php

namespace app\Controllers\Admin;

use app\Repositories\EventPhotoRepository;
use vendor\Evd\Main\Viewer;

class EventPhotoAdminController extends MainAdminController
{
    private EventPhotoRepository $eventPhotoRepository;
    public function __construct()
    {
        parent::__construct();
        $this->eventPhotoRepository = new EventPhotoRepository();
    }

    public function editPage($data)
    {
        if (empty($data["id"])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $eventId = $data["id"];
        $photos = $this->eventPhotoRepository->getPhotosForAdmin($eventId);

        Viewer::view("admin/events/photos/edit", compact("photos", "eventId"));

    }
}