<?php

namespace app\Repositories;

use app\Models\User;

class UserRepository extends MainRepository
{
    /**
     * Получить класс модели
     * @return string
     */
    protected function getModelClass()
    {
        return User::class;
    }

    public function registrationAndGetUser($data): object
    {
        $this
            ->startRequest()
            ->create(
                [
                    "name" => $data["name"],
                    "email" => $data["email"],
                    "password" => md5($data["password"]),
                ]
            );

        $user = $this
            ->startRequest()
            ->one(["email" => $data["email"]],
                [
                    "id",
                    "name",
                ])
            ->find();

        return $user;
    }

    /**
     * Проверка существавания пользователя по email
     * @param $email
     * @return bool
     */
    public function checkUserByEmail($email): bool
    {
        $user = $this
            ->startRequest()
            ->one(["email" => $email], ["id"])
            ->find();

        return !empty($user);
    }

    public function getUserForAuth($email)
    {
        $user = $this
            ->startRequest()
            ->one(["email" => $email])
            ->find();

        return $user;
    }

    /**
     * Получить имя и email пользователя для страницы заказа
     * @param $id
     * @return mixed
     */
    public function getUserForOrderPage($id)
    {
        $user = $this
            ->startRequest()
            ->one(["id" => $id], ["name", "email"])
            ->find();

        return $user;
    }
}