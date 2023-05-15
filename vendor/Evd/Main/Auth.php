<?php

namespace vendor\Evd\Main;

class Auth
{
    /**
     * Авторизация через сессию
     * @param $user
     * @return bool
     */
    public static function auth($user):bool
    {
        if(!empty($_SESSION["auth"])) return false;

        $_SESSION["auth"] = $user;

        return true;
    }

    /**
     * Проверка авторизации пользователя
     * @return bool
     */
    public static function guest()
    {
        if(!empty($_SESSION["auth"])) {
            return false;
        }else{
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
}