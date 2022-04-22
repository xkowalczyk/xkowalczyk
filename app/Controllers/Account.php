<?php

namespace App\Controllers;

use App\Libraries\Services\OrderService;
use CodeIgniter\Controller;
use App\Libraries\Services\SessionService;
use App\Libraries\Services\SuppliersService;
use App\Libraries\Services\UserAddressService;
use App\Libraries\Services\UserService;

class Account extends Controller
{
    private $sessionService;
    private $userService;
    private $userAddressService;
    private $orderService;
    private $suppliersService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
        $this->userService = new UserService();
        $this->userAddressService = new UserAddressService();
        $this->orderService = new OrderService();
        $this->suppliersService = new SuppliersService();
    }

    public function index()
    {
        if ($this->sessionService->checkIssetSession('userLogged') == false) {
            return redirect()->to(base_url('login'));
        }

        $SystemLang['userObject'] = $this->userService->getSingleUser($this->sessionService->getSingleSession('userLogged'));

        echo view('templates/header.php');
        echo view('UserAccount/header.php');
        echo view('UserAccount/index.php', $SystemLang);
    }

    public function orders()
    {
        if ($this->sessionService->checkIssetSession('userLogged') == false) {
            return redirect()->to(base_url('login'));
        }

        $SystemLang['orders'] = $this->orderService->getUserOrders($this->userService->getSingleUser($this->sessionService->getSingleSession('userLogged'))[0]->user_id);;
        echo view('templates/header.php');
        echo view('UserAccount/header.php');
        echo view('UserAccount/modules/ordersModule.php', $SystemLang);
    }

    public function checkorder($orderId = null)
    {
        if ($this->sessionService->checkIssetSession('userLogged') == false) {
            return redirect()->to(base_url('login'));
        } else if ($orderId == null){
            return redirect()->to(base_url('orders'));
        }

        $order = $this->orderService->getSingleOrder($orderId)[0];

        if($order == null){
            return redirect()->to(base_url('orders'));
        }

        if($order->order_client_id != $this->userService->getSingleUser($this->sessionService->getSingleSession('userLogged'))[0]->user_id){
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Lista zamówień', 'errorDetails' => 'Nieautoryzowana próba podglądu zamówienia', 'errorToPage' => 'account']);
            return redirect()->to(base_url('error'));
        }

        $orderStatus = null;
        switch($order->order_status){
            case "1":{
                $orderStatus = "Zamówienie złożone: oczekiwanie na płatność";
            }
        }

        $SystemLang['orderStatus'] = $orderStatus;
        $SystemLang['order'] = $order;
        if($this->suppliersService->getSingleSupplier($order->order_shipping) != null){
            $SystemLang['supplier'] = $this->suppliersService->getSingleSupplier($order->order_shipping);
        }

        echo view('templates/header.php');
        echo view('UserAccount/header.php');
        echo view('UserAccount/modules/checkOrderModule.php', $SystemLang);
    }

    public function personal()
    {
        if ($this->sessionService->checkIssetSession('userLogged') == false) {
            return redirect()->to(base_url('login'));
        }

        $SystemLang['userObject'] = $this->userService->getSingleUser($this->sessionService->getSingleSession('userLogged'));
        echo view('templates/header.php');
        echo view('UserAccount/header.php');
        echo view('UserAccount/modules/personalDataModule.php', $SystemLang);
    }

    public function address($action = 'view')
    {
        if ($this->sessionService->checkIssetSession('userLogged') == false) {
            return redirect()->to(base_url('login'));
        }

        if ($action == 'view') {
            $SystemLang['userAddress'] = $this->userAddressService->getUserAddress($this->userService->getSingleUser($this->sessionService->getSingleSession('userLogged'))[0]->user_id);
            echo view('templates/header.php');
            echo view('UserAccount/header.php');
            echo view('UserAccount/modules/addressModule.php', $SystemLang);
        } else if ($action == 'edit') {
            $SystemLang['userAddress'] = $this->userAddressService->getSingleAddress($this->request->getPost('address_id'))[0];
            echo view('templates/header.php');
            echo view('UserAccount/header.php');
            echo view('UserAccount/modules/editAddressModule.php', $SystemLang);
        } else if ($action == 'add') {
            $SystemLang['userId'] = $this->userService->getSingleUser($this->sessionService->getSingleSession('userLogged'))[0]->user_id;
            echo view('templates/header.php');
            echo view('UserAccount/header.php');
            echo view('UserAccount/modules/addAddressModule.php', $SystemLang);
        } else {
            return redirect()->to(base_url('account'));
        }
    }
}
