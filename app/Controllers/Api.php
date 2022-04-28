<?php

namespace App\Controllers;

use App\Libraries\Services\BinService;
use App\Libraries\Services\ProductService;
use CodeIgniter\Controller;
use App\Libraries\Services\SessionService;
use App\Libraries\Services\UserAddressService;
use App\Libraries\Services\UserService;
use App\Libraries\Services\OrderService;

class Api extends Controller
{
    private $userAddressService;
    private $sessionService;
    private $binService;
    private $userService;
    private $orderService;
    private $productService;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->userAddressService = new UserAddressService();
        $this->sessionService = new SessionService();
        $this->binService = new BinService();
        $this->userService = new UserService();
        $this->orderService = new OrderService();
        $this->productService = new ProductService();
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
        if (!empty($_POST)) {
            if (
                !empty($_POST["KWOTA"]) &&
                !empty($_POST["ID_PLATNOSCI"]) &&
                !empty($_POST["ID_ZAMOWIENIA"]) &&
                !empty($_POST["STATUS"]) &&
                !empty($_POST["SEKRET"]) &&
                !empty($_POST["SECURE"]) &&
                !empty($_POST["HASH"])
            ) {
                if (hash("sha256", "TKfqVda3;" . $_POST["KWOTA"] . ";" . $_POST["ID_PLATNOSCI"] . ";" . $_POST["ID_ZAMOWIENIA"] . ";" . $_POST["STATUS"] . ";" . $_POST["SECURE"] . ";" . $_POST["SEKRET"]) == $_POST["HASH"]) {
                    if ($_POST["STATUS"] == "SUCCESS") {
                        $this->orderService->editOrderStatus($this->request->getPost('ID_ZAMOWIENIA'), 2);
                    } else if ($_POST["STATUS"] == "FAILURE") {
                        $this->orderService->editOrderStatus($this->request->getPost('ID_ZAMOWIENIA'), 3);
                    } else if ($_POST["STATUS"] == "PENDING") {
                        $this->orderService->editOrderStatus($this->request->getPost('ID_ZAMOWIENIA'), 4);
                    }
                }
            } else {
                echo "BRAK WYMAGANYCH DANYCH";
            }
        }
    }

    public function admin()
    {
        if ($this->sessionService->checkIssetSession('adminLogged') == false) {
            $response = "error-noauthenticate";
            return json_encode($response);
        }

        $action = $this->request->getPost('action');
        $value = $this->request->getPost('value');

        if ($action == "" && $value == "") {
            $response = "eror-novalue";
            return json_encode($response);
        } else {
            $response = $this->checkAdminRequest($action, $value);
            return json_encode($response);
        }
    }

    private function checkAdminRequest($action, $value)
    {
        switch ($action)
        {
            case "updateOrderStatus":{
                $this->orderService->editOrderStatus($value, $this->request->getPost('status'));
            } break;
            case "editUserAccount": {
                $user_id = $this->request->getPost('value');
                $user_name = $this->request->getPost('name');
                $user_lastname = $this->request->getPost('lastname');
                $user_login = $this->request->getPost('login');
                $user_email = $this->request->getPost('email');

                if ($user_name == '' || $user_lastname == '' || $user_login == '' || $user_email == '') {
                    return 'error_novalue';
                }

                $editData = array('user_name' => $user_name, 'user_lastname' => $user_lastname, 'user_login' => $user_login, 'user_email' => $user_email);
                $this->userService->editUser($user_id, $editData);
                return;
            } break;
            case "editUserAddress": {
                $address_id = $this->request->getPost('value');
                $address_city = $this->request->getPost('city');
                $address_street = $this->request->getPost('street');
                $address_postcode = $this->request->getPost('postcode');
                $address_homenumber = $this->request->getPost('homenumber');

                if ($address_city == '' || $address_street == '' || $address_postcode == '' || $address_homenumber == '') {
                    return 'error_novalue';
                }

                $editData = array('user_address_street' => $address_street, 'user_address_city' => $address_city, 'user_address_postcode' => $address_postcode, 'user_address_homenumber' => $address_homenumber);
                $this->userAddressService->editAddress($address_id, $editData);
            } break;
            case "removeUserAddress": {
                $address_id = $this->request->getPost('value');

                if ($address_id == '') {
                    return 'error_novalue';
                }

                $this->userAddressService->removeAddress($address_id);
            } break;
            case "addUserToBlackList": {
                return $this->userService->putUserToBlackList($value);
            } break;
            case "removeUserBlackList": {
                return $this->userService->removeUserBlackList($value);
            } break;
            case "editProduct" : {
                $productName = $this->request->getPost('name');
                $productDescription = $this->request->getPost('description');
                $productPrice = $this->request->getPost('price');
                $productCategory = $this->request->getPost('category');
                $productSubcategory = $this->request->getPost('subcategory');

                $productParameters = array(
                  'item_name' => $productName,
                  'item_description' => $productDescription,
                  'item_price' => $productPrice,
                  'item_category_id' => $productCategory,
                  'item_subcategory_id' => $productSubcategory
                );

                $this->productService->editProduct($value, $productParameters);
            } break;
            case "editProductPhoto" : {
                $file = $this->request->getFile('image');
                $file_name = $file->getRandomName();
                $file->move('.public/graph/products/', $file_name);

            } break;
            default: {
                return "error_invalidaction";
            }
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

                    if ($address_city == '' || $address_street == '' || $address_postcode == '' || $address_homenumber == '') {
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

                    if ($address_city == '' || $address_street == '' || $address_postcode == '' || $address_homenumber == '') {
                        return 'error_novalue';
                    }

                    $addressParameters = array('user_address_user_id' => $user_id, 'user_address_user' => $this->sessionService->getSingleSession('userLogged'), 'user_address_street' => $address_street, 'user_address_city' => $address_city, 'user_address_postcode' => $address_postcode, 'user_address_homenumber' => $address_homenumber);
                    $this->userAddressService->putAddress($addressParameters);
                }
                break;
            case "removeAddress": {
                    $address_id = $this->request->getPost('value');

                    if ($address_id == '') {
                        return 'error_novalue';
                    }

                    $this->userAddressService->removeAddress($address_id);
                }
                break;
            case "userLogout": {
                    $this->sessionService->removeSession('userLogged');
                }
                break;
            default: {
                    return "error_invalidaction";
                }
        }
    }

    public function file()
    {
        $img = $this->request->getFile('userfile');

        if (! $img->hasMoved()) {
            $filepath = WRITEPATH . 'uploads/' . $img->store();

            $data = ['uploaded_flleinfo' => new File($filepath)];

        }
    }
}
