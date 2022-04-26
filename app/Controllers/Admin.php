<?php

namespace App\Controllers;

use App\Libraries\Services\OrderService;
use App\Libraries\Services\ProductService;
use App\Libraries\Services\SuppliersService;
use App\Libraries\Services\UserService;
use CodeIgniter\Controller;
use App\Libraries\Services\SessionService;

class Admin extends Controller
{
    private $sessionService;
    private $orderService;
    private $productService;
    private $userService;
    private $suppliersService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
        $this->orderService = new OrderService();
        $this->productService = new ProductService();
        $this->userService = new UserService();
        $this->suppliersService = new SuppliersService();
    }

    public function index()
    {
        //$this->sessionService->setSession('adminLogged', 'ytmrhc@gmail.com');
        if(!$this->sessionService->checkIssetSession('adminLogged')){
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Admin', 'errorDetails' => 'Brak autoryzacjii', 'errorToPage' => 'home']);
            return redirect()->to(base_url('error'));
        }

        echo view('Admin/header.php');
    }

    public function orders()
    {
        $SystemLang['usersOrders'] = $this->orderService->getAllOrders();
        echo view('Admin/header.php');
        echo view('Admin/modules/adminOrdersModule.php', $SystemLang);
    }

    public function ordermanager($orderId = null)
    {
        if ($orderId == null)
        {
            return redirect()->to(base_url('admin'));
        }

        $order = $this->orderService->getSingleOrder($orderId)[0];
        $orderProduct = $this->productService->getChoseProducts(explode(',',$order->order_product));
        $user = $this->userService->getSingleUser($order->order_client_id);

        if ($order == null) {
            return redirect()->to(base_url('orders'));
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
    print_r($order);
        echo view('Admin/header.php');
        echo view('Admin/modules/adminOrderManagerModule.php', $SystemLang);
    }
}
