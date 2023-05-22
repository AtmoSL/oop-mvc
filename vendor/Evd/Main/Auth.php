<?php

namespace vendor\Evd\Main;

class Auth
{
    /**
     * Авторизация через сессию
     * @param $user
     * @return bool
     */
    public static function auth($user): bool
    {
        if (!empty($_SESSION["auth"])) return false;

        $_SESSION["auth"] = [
            "id" => $user->id,
            "name" => $user->name,
            "role_id" => $user->role_id
        ];

        return true;
    }

    /**
     * Проверка авторизации пользователя
     * @return bool
     */
    public static function guest()
    {
        if (!empty($_SESSION["auth"])) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Выход из аккаунта, удаление пользователя из сессии
     * @return void
     */
    public static function logout()
    {
        unset($_SESSION["auth"]);
    }

    /**
     * Получение id пользователя из сессии
     * @return false|mixed
     */
    public static function userId()
    {
        if (empty($_SESSION["auth"])) {
            return false;
        }

        return $_SESSION["auth"]["id"];
    }

    /**
     * Проверка, является ли пользователь администратором
     * @return bool
     */
    public function isAdmin()
    {
        if($_SESSION["auth"]["role_id"] == 2){
            return true;
        }
        else{
            return false;
        }
    }
}