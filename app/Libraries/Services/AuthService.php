<?php

namespace App\Libraries\Services;

use App\Libraries\Services\SessionService;
use App\Libraries\Services\UserService;
use App\Libraries\Services\UserAddressService;
use App\Libraries\User;


class AuthService
{

    private $userService;
    private $addressService;
    private $sessionService;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->sessionService = new SessionService();
        $this->addressService = new UserAddressService();
    }

    public function checkLoginUser($userEmail)
    {
        if ($this->userService->registerCheck($userEmail) == false) {
            return [false, 'error_noregister'];
        } else if ($this->userService->getSingleConfirmUserStatus($userEmail) == false) {
            return [false, 'error_noconfirm'];
        } else if ($this->userService->getSingleBlackListStatus($userEmail) == true) {
            return [false, 'error_blacklist'];
        } else if ($this->sessionService->checkIssetSession('user_logged') == true) {
            return [false, 'error_logged'];
        } else {
            return true;
        }
    }

    public function checkRegisterUser($userEmail)
    {
        if ($this->userService->getSingleBlackListStatus($userEmail) == true) {
            return [false, 'error_blacklist'];
        } else if ($this->userService->registerCheck($userEmail) == true) {
            return [false, 'error_alreadyregister'];
        } else {
            return true;
        }
    }

    public function checkUserPassword($userEmail, $userPassword)
    {
        $trueUserPassword = $this->userService->getUserPassword($userEmail);
        
        if (password_verify($userPassword, $trueUserPassword) == true) {
            return true;
        } else {
            return false;
        }
    }

    public function setLoginSession($userEmail)
    {
        $this->sessionService->setSession('userLogged', $userEmail);
    }

    public function putUser($userName, $userLastname, $userEmail, $userLogin, $userPassword, $addressCity, $addressHomeNumber, $addressStreet, $addressPostCode)
    {
        $this->userService->putUser(ucfirst($userName), ucfirst($userLastname), $userEmail, $userLogin, password_hash($userPassword, PASSWORD_DEFAULT));
        $this->addressService->putAddress($userEmail, ucfirst($addressCity), $addressHomeNumber, $addressStreet, $addressPostCode);
        $this->userService->putNewConfirmStatus($userEmail);
    }
}
