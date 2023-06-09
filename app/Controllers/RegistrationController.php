<?php

namespace app\Controllers;

use app\Repositories\UserRepository;
use app\Validators\UserValidator;
use vendor\Evd\Main\Auth;
use vendor\Evd\Main\Viewer;

class RegistrationController
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

        Viewer::view("registration");
    }

    /**
     * Метод регистрации
     * @param $data
     * @return void
     */
    public function register($data)
    {
        if(!Auth::guest()){
            header("Location: /");
            die();
        }

        $validator = new UserValidator();
        $validation = $validator->validateAll($data);

        $isUserExist = $this->userRepository->checkUserByEmail($data["email"]);
        if($isUserExist){
            $_SESSION["registrationMessages"]["email"]["errorMessages"][] = "Почта занята";
            header("Location: /registration");
        }

        if (!$validation['isFullValidated']) {
            $_SESSION["registrationMessages"] = $validation["fields"];
            header("Location: /registration");
        } else {
            $user = $this->userRepository->registrationAndGetUser($data);

            Auth::auth($user);

            header("Location: /");
        }
    }
}