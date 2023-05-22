<?php

namespace app\Repositories;

use app\Models\OrderStatus;

class OrderStatusRepository extends MainRepository
{

    /**
     * Получить класс модели
     * @return string
     */
    protected function getModelClass() :string
    {
        return OrderStatus::class;
    }

    /**
     * Получить список всех статусов
     * @return mixed
     */
    public function getAllStatuses()
    {
        $statuses = $this
            ->startRequest()
            ->all()
            ->find();

        return $statuses;
    }
}