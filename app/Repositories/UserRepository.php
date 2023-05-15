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

    public function registrationAndGetUser($data): Object
    {
        User::create(
            [
                "name" => $data["name"],
                "email" => $data["email"],
                "password" => md5($data["password"]),
            ]
        );

        $user = $this
            ->startRequest()
            ->one(["email" => $data["email"]])
            ->find();

        return $user;
    }

    /**
     * Проверка существавания пользователя по email
     * @param $email
     * @return bool
     */
    public function checkUserByEmail($email):bool
    {
        $user = $this
            ->startRequest()
            ->one(["email" => $email])
            ->find();

        return !empty($user);
    }
}