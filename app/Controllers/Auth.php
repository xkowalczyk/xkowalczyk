<?php

namespace App\Controllers;

use App\Libraries\Services\AuthService;
use App\Libraries\Services\EmailService;
use App\Libraries\Services\SessionService;
use App\Libraries\Services\UserAddressService;
use App\Libraries\Services\UserService;
use CodeIgniter\Controller;

class Auth extends Controller
{
    private $authService;
    private $sessionService;
    private $userService;
    private $emailService;
    private $userAddressService;
    protected $request;

    public function __construct()
    {
        $this->authService = new AuthService();
        $this->sessionService = new SessionService();
        $this->userService = new UserService();
        $this->emailService = new EmailService();
        $this->userAddressService = new UserAddressService();
    }

    public function index()
    {
    }

    public function login()
    {
        if ($this->sessionService->checkIssetSession('adminLogged') == true) {
            return redirect()->to(base_url('admin'));
        }

        $data = $this->getLoginFormPool();

        if ($this->sessionService->checkIssetSession('userLogged') == true) {
            return redirect()->to(base_url('account'));
        }

        if ($data == false) {
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Logowanie', 'errorDetails' => 'Logujesz się ze złej strony', 'errorToPage' => 'login']);
            return redirect()->to(base_url('error'));
        }

        if ($this->authService->checkLoginUser($data['userEmail']) == 1) {
        } else {
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Logowanie', 'errorDetails' => $this->authService->checkLoginUser($data['userEmail'])[1], 'errorToPage' => 'login']);
            return redirect()->to(base_url('error'));
        }

        if ($this->authService->checkUserPassword($data['userEmail'], $data['userPassword']) == false) {
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Logowanie', 'errorDetails' => 'Błędne hasło', 'errorToPage' => 'login']);
            return redirect()->to(base_url('error'));
        } else {
            if ($this->userService->getAccountType($data['userEmail']) == 0) {
                $this->authService->setLoginSession($data['userEmail']);
                return redirect()->to(base_url('account'));
            } else if ($this->userService->getAccountType($data['userEmail']) == 1) {
                $this->sessionService->setSession('adminLogged', $data['userEmail']);
                return redirect()->to(base_url('admin'));
            }
        }
    }

    public function register()
    {
        if ($this->sessionService->checkIssetSession('adminLogged') == true) {
            return redirect()->to(base_url('admin'));
        }

        $data = $this->getRegisterFormPool();

        if ($this->sessionService->checkIssetSession('userLogged') == true) {
            return redirect()->to(base_url('account'));
        }

        if ($data == false) {
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Logowanie', 'errorDetails' => 'Logujesz się ze złej strony', 'errorToPage' => 'login']);
            return redirect()->to(base_url('error'));
        }

        if ($this->authService->checkRegisterUser($data['userEmail']) == 1) {
        } else {
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Logowanie', 'errorDetails' => $this->authService->checkRegisterUser($data['userEmail'])[1], 'errorToPage' => 'register']);
            return redirect()->to(base_url('error'));
        }

        $this->authService->putUser(
            $data['userName'],
            $data['userLastname'],
            $data['userEmail'],
            $data['userLogin'],
            $data['userPassword'],
            $data['userCity'],
            $data['userHomenumber'],
            $data['userStreet'],
            $data['userPostcode'],
        );

        $addressParameters = array(
            'user_address_user' =>$data['userEmail'],
            'user_address_user_id' => $this->userService->getSingleUser($data['userEmail'])[0]->user_id,
            'user_address_street' =>$data['userStreet'],
            'user_address_city' =>$data['userCity'],
            'user_address_homenumber' =>$data['userHomenumber'],
            'user_address_postcode' =>$data['userPostcode']
        );

        $this->emailService->sendActiveAccountEmail($data['userEmail'], $data['userName']);
        $this->userAddressService->putAddress($addressParameters);
        $this->sessionService->setFlashData('successData', ['successName' => 'Rejestracja', 'successDetails' => 'Konto założone, potwierdź rejstracje na poczcie', 'successToPage' => 'login']);
        return redirect()->to(base_url('success'));
    }

    private function getLoginFormPool()
    {
        $data = $this->request->getPost([
            'userEmail',
            'userPassword',
            'loginToken'
        ]);

        foreach ($data as $pool) {
            if ($pool == null) {
                return false;
            }
        }

        return $data;
    }

    private function getRegisterFormPool()
    {
        $data = $this->request->getPost([
            'userName',
            'userLastname',
            'userHomenumber',
            'userCity',
            'userPostcode',
            'userStreet',
            'userEmail',
            'userLogin',
            'userPassword',
            'registerToken'
        ]);

        foreach ($data as $pool) {
            if ($pool == null) {
                return false;
            }
        }

        return $data;
    }
}
