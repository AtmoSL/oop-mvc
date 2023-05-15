<?php

namespace app\Controllers;

use app\Repositories\UserRepository;
use vendor\Evd\Main\Auth;
use vendor\Evd\Main\Viewer;

class LoginController
{
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function index()
    {
        if(!Auth::guest()){
            header("Location: /");
            die();
        }

        Viewer::view("login");
    }

    public function login($data)
    {
        if(!Auth::guest()){
            header("Location: /");
            die();
        }

        $isUserExist = $this->userRepository->checkUserByEmail($data["email"]);

        if (!$isUserExist) {
            $_SESSION["loginMessages"]["email"]["errorMessages"][] = "Аккаунт не найден";
            header("Location: /login");
            die();
        }


        $user = $this->userRepository->getUserForAuth($data["email"]);

        if (md5($data["password"]) == $user->password) {
            Auth::auth($user);
            header("Location: /");
        } else {
            $_SESSION["loginMessages"]["password"]["errorMessages"][] = "Пароль не подходит";
            header("Location: /login");
        }

    }

    /**
     * Выход из аккаунта
     * @return void
     */
    public function logout()
    {
        if(Auth::guest()){
            header("Location: /");
            die();
        }

        Auth::logout();
        header("Location: /");
    }
}