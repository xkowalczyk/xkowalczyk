<?php

namespace App\Libraries;
use App\Models\UserModel;

class AuthSystem{

    private $userModel;

    public function __construct()
    {
        $this->userModel = model(UserModel::class);
    }

    public function checkLogin($userEmail, $userPassword){
        $dbPassword = $this->userModel->getPassword($userEmail);
        
        if(password_verify($userPassword, $dbPassword) == true){
            
        }
    }
}