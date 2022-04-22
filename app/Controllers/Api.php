<?php

namespace App\Controllers;

use App\Libraries\Services\BinService;
use CodeIgniter\Controller;
use App\Libraries\Services\SessionService;
use App\Libraries\Services\UserAddressService;
use App\Libraries\Services\UserService;

class Api extends Controller
{
    private $userAddressService;
    private $sessionService;
    private $binService;
    private $userService;

    public function __construct()
    {
        $this->userAddressService = new UserAddressService();
        $this->sessionService = new SessionService();
        $this->binService = new BinService();
        $this->userService = new UserService();
    }

    public function index()
    {
        $response = null;

        $action = $this->request->getPost('action');
        $value = $this->request->getPost('value');

        if ($action == "" && $value == "") {
            $response = "eror-novalue";
            return json_encode($response);
        } else {
            $response = $this->checkRequest($action, $value);
            return json_encode($response);
        }
    }

    public function payment()
    {

    }

    public function admin()
    {
        $response = null;

        if ($this->sessionService->checkIssetSession('adminLogged') == false) {
            $response = "error-noauthenticate";
            return json_encode($response);
        }
    }

    private function checkRequest($action, $value)
    {
        switch ($action) {
            case "addItemToBin": {
                    return $this->binService->addItemToBin($value);
                }
                break;
            case "dellBinItem": {
                    return $this->binService->dellBinItem($value);
                }
                break;
            case "editAccount": {
                    $user_id = $this->request->getPost('value');

                    if ($user_id != $this->userService->getSingleUser($this->sessionService->getSingleSession('userLogged'))[0]->user_id) {
                        return "error_antiattack";
                    }

                    $user_name = $this->request->getPost('name');
                    $user_lastname = $this->request->getPost('lastname');
                    $user_login = $this->request->getPost('login');

                    if ($user_name == '' || $user_lastname == '' || $user_login == '') {
                        return 'error_novalue';
                    }

                    $editData = array('user_name' => $user_name, 'user_lastname' => $user_lastname, 'user_login' => $user_login);
                    $this->userService->editUser($user_id, $editData);
                    return;
                }
                break;
            case "editAddress": {
                    $address_id = $this->request->getPost('value');

                    $address_city = $this->request->getPost('city');
                    $address_street = $this->request->getPost('street');
                    $address_postcode = $this->request->getPost('postcode');
                    $address_homenumber = $this->request->getPost('homenumber');

                    if($address_city == '' || $address_street == '' || $address_postcode == '' || $address_homenumber == ''){
                        return 'error_novalue';
                    }

                    $editData = array('user_address_street' => $address_street, 'user_address_city' => $address_city, 'user_address_postcode' => $address_postcode, 'user_address_homenumber' => $address_homenumber);
                    $this->userAddressService->editAddress($address_id, $editData);
                }
                break;
            case "addAddress": {
                    $user_id = $this->request->getPost('value');

                    if ($user_id != $this->userService->getSingleUser($this->sessionService->getSingleSession('userLogged'))[0]->user_id) {
                        return 'error_antiattack';
                    }

                    $address_city = $this->request->getPost('city');
                    $address_street = $this->request->getPost('street');
                    $address_postcode = $this->request->getPost('postcode');
                    $address_homenumber = $this->request->getPost('homenumber');

                    if($address_city == '' || $address_street == '' || $address_postcode == '' || $address_homenumber == ''){
                        return 'error_novalue';
                    }

                    $addressParameters = array('user_address_user_id' => $user_id, 'user_address_user' => $this->sessionService->getSingleSession('userLogged'), 'user_address_street' => $address_street, 'user_address_city' => $address_city, 'user_address_postcode' => $address_postcode, 'user_address_homenumber' => $address_homenumber);
                    $this->userAddressService->putAddress($addressParameters);
            } break;
            case "removeAddress":{
                $address_id = $this->request->getPost('value');
                
                if($address_id == ''){
                    return 'error_novalue';
                } 

                $this->userAddressService->removeAddress($address_id);
            } break;
            case "userLogout":{
                $this->sessionService->removeSession('userLogged');
            }break;
            default: {
                    return "error_invalidaction";
                }
        }
    }
}
