<?php

namespace app\Controllers;

use app\Validators\UserValidator;
use vendor\Evd\Main\Viewer;

class RegistrationController
{
    public function index()
    {
        Viewer::view("registration");
    }

    /**
     * Метод регистрации
     * @param $data
     * @return void
     */
    public function register($data)
    {
        $validator = new UserValidator();
        $validation = $validator->validateAll($data);

        if (!$validation['isFullValidated']) {
            $_SESSION["registrationMessages"] = $validation["fields"];
            debug($_SESSION["registrationMessages"]);
        } else {
            debug("Валидация пройдена");
        }
    }
}