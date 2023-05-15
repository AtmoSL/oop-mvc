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

    public static function guest()
    {
        if(!empty($_SESSION["auth"])) {
            return false;
        }else{
            return true;
        }
    }
}