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

    public function addPhoto($data)
    {
        if (empty($data) || empty($_FILES)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $eventId = $data["eventId"];

        $fileTmpPath = $_FILES['photo']['tmp_name'];
        $fileFullName = explode('.', basename($_FILES['photo']['name']));
//        $fileName = $fileFullName[0];
        $fileExtension = $fileFullName[1];
//        $fileSize = $_FILES['photo']['size'];
//        $fileType = $_FILES['photo']['type'];

        $uploadDir = 'img/events/'.$eventId;
        $newName = uniqid().".".$fileExtension;

        $uploadFile = $uploadDir . '/'. $newName;

        move_uploaded_file($fileTmpPath, $uploadFile);

        $this->eventPhotoRepository->addPhotoForEvent($newName, $eventId);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function deletePhoto($data)
    {
        if (empty($data)) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $photoId = $data["photoId"];

        $photo = $this->eventPhotoRepository->getPhotoById($photoId);
        $photoPath = "img/events/".$photo->event_id."/".$photo->photo;
        $this->eventPhotoRepository->deletePhoto($photoId);

        unlink($photoPath);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}