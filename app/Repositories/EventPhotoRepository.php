<?php

namespace app\Repositories;

use app\Models\EventPhotos;

class EventPhotoRepository extends MainRepository
{
    /**
     * Получить класс модели
     * @return string
     */
    protected function getModelClass()
    {
        return EventPhotos::class;
    }

    /**
     * Получить фотографии для корусели события
     * @param $eventId
     * @return mixed
     */
    public function getPhotosForEventCarousel($eventId)
    {
        $photos = $this
            ->startRequest()
            ->where(["event_id"=>$eventId], ["photo"])
            ->find();

        return $photos;
    }

    public function getPhotosForAdmin($eventId)
    {
        $photos = $this
            ->startRequest()
            ->where(["event_id"=>$eventId], ["photo", "id"])
            ->find();

        return $photos;
    }

    public function addPhotoForEvent($photoName, $eventId)
    {
        $this->startRequest()
            ->create([
                "event_id" => $eventId,
                "photo" => $photoName
            ]);
    }

    /**
     * Получить фото по id
     * @param $id
     * @return mixed
     */
    public function getPhotoById($id)
    {
        $photo = $this->startRequest()
            ->one(["id"=>$id])
            ->find();

        return $photo;
    }

    /**
     * Удаление фото по id
     * @param $id
     * @return true
     */
    public function deletePhoto($id)
    {
        $this->startRequest()
            ->where(["id"=>$id])
            ->delete();

        return true;
    }
}