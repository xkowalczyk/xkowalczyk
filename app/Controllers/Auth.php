<?php

namespace App\Controllers;

use App\Libraries\AuthSystem;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    private $userModel;
    private $AuthSystem;

    public function __construct()
    {
        $this->userModel = model(UserModel::class);
        $this->AuthSystem = new AuthSystem();
    }

    public function index()
    {
    }

    public function register()
    {
    }

    public function login()
    {
        if (!isset($_POST['user_email']) and !isset($_POST['user_password']) and !isset($_POST['login_token'])) {
            return;
        } else if ($this->userModel->checkUser($_POST['user_email'])[1] == false) {
            return;
        } else {
            $userCheckEmail = $_POST['user_email'];
            $userCheckPassword = password_hash($_POST['user_password'], PASSWORD_DEFAULT);
        }

        $this->AuthSystem->checkLogin($userCheckEmail, $userCheckPassword);
    }
}
