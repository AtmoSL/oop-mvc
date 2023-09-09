<?php

namespace app\Controllers\Admin;

use app\Repositories\UserRepository;
use vendor\Evd\Main\Auth;
use vendor\Evd\Main\Viewer;

class UserAdminController extends MainAdminController
{

    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function usersPage()
    {
        $admins = $this->userRepository->getAllAdmins();

        Viewer::view("admin/users/allUsers", compact("admins"));
    }

    public function deleteAdmin($data)
    {
        if (empty($data["id"])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }

        $userId = $data["id"];

        if (Auth::userId() == $userId) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            return false;
        }
        $this->userRepository->unsetAdmin($userId);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        return true;
    }
}