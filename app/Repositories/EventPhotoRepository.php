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
}