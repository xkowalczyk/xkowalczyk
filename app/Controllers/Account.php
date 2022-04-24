<?php

namespace App\Controllers;

use App\Libraries\PayForm;
use CodeIgniter\Controller;
use App\Libraries\Services\OrderService;
use App\Libraries\Services\ProductService;
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
    private $productService;
    private $payForm;

    public function __construct()
    {
        $this->sessionService = new SessionService();
        $this->userService = new UserService();
        $this->userAddressService = new UserAddressService();
        $this->orderService = new OrderService();
        $this->suppliersService = new SuppliersService();
        $this->productService = new ProductService();
        $this->payForm = new PayForm();
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
        } else if ($orderId == null) {
            return redirect()->to(base_url('orders'));
        }

        $order = $this->orderService->getSingleOrder($orderId)[0];
        $orderProduct = $this->productService->getChoseProducts(explode(',',$order->order_product));
        $user = $this->userService->getSingleUser($this->sessionService->getSingleSession('userLogged'))[0];

        if ($order == null) {
            return redirect()->to(base_url('orders'));
        }

        if ($order->order_client_id != $this->userService->getSingleUser($this->sessionService->getSingleSession('userLogged'))[0]->user_id) {
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Lista zamówień', 'errorDetails' => 'Nieautoryzowana próba podglądu zamówienia', 'errorToPage' => 'account']);
            return redirect()->to(base_url('error'));
        }

        switch ($order->order_status) {
            case "1": {
                $orderStatus = "Zamówienie złożone: oczekiwanie na płatność";
            }break;
            case "2": {
                $orderStatus = "Zamówienie złożone: Płatność zaksięgowana";
            }break;
            case "3": {
                $orderStatus = "Zamówienie złożone: Płatność anulowana";
            }break;
            case "4": {
                $orderStatus = "Zamówienie złożone: Płatność w toku";
            }break;
            case "5": {
                $orderStatus = "Zamówienie złożone: Wysłane";
            }break;
            case "6": {
                $orderStatus = "Zamówienie zostało anulowane";
            }break;
        }

        if ($this->suppliersService->getSingleSupplier($order->order_shipping) != null) {
            $SystemLang['supplier'] = $this->suppliersService->getSingleSupplier($order->order_shipping)[0];
        }

        $SystemLang['orderStatus'] = $orderStatus;
        $SystemLang['order'] = $order;
        $SystemLang['orderProduct'] = $orderProduct;
        $SystemLang['orderAmount'] = $order->order_amount;

        echo view('templates/header.php');
        echo view('UserAccount/header.php');
        echo view('UserAccount/modules/checkOrderModule.php', $SystemLang);

        if($order->order_status == '1' || $order->order_status == '3'){
            $this->payForm->generatePayForm($user->user_email, $user->user_name, $order->order_id, 'Płatność za zamówienie', '10');
        }
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
