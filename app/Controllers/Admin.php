<?php

namespace App\Controllers;

use App\Libraries\Services\CategoryService;
use App\Libraries\Services\ConfigService;
use App\Libraries\Services\OrderService;
use App\Libraries\Services\ProductService;
use App\Libraries\Services\SuppliersService;
use App\Libraries\Services\TempAddressService;
use App\Libraries\Services\UserAddressService;
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
    private $userAddressService;
    private $tempAddressService;
    private $categoryService;
    private $configService;

    public function __construct()
    {
        $this->sessionService = new SessionService();
        $this->orderService = new OrderService();
        $this->productService = new ProductService();
        $this->userService = new UserService();
        $this->suppliersService = new SuppliersService();
        $this->userAddressService = new UserAddressService();
        $this->tempAddressService = new TempAddressService();
        $this->categoryService = new CategoryService();
        $this->configService = new ConfigService();
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
        if(!$this->sessionService->checkIssetSession('adminLogged')){
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Admin', 'errorDetails' => 'Brak autoryzacjii', 'errorToPage' => 'home']);
            return redirect()->to(base_url('error'));
        }
        $SystemLang['usersOrders'] = $this->orderService->getAllOrders();
        echo view('Admin/header.php');
        echo view('Admin/modules/adminOrdersModule.php', $SystemLang);
    }

    public function ordermanager($orderId = null)
    {
        if(!$this->sessionService->checkIssetSession('adminLogged')){
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Admin', 'errorDetails' => 'Brak autoryzacjii', 'errorToPage' => 'home']);
            return redirect()->to(base_url('error'));
        }
        if ($orderId == null)
        {
            return redirect()->to(base_url('admin'));
        }

        $order = $this->orderService->getSingleOrder($orderId)[0];
        $orderProduct = $this->productService->getChoseProducts(explode(',',$order->order_product));
        $user = $this->userService->getSingleUser($order->order_client_id);

        if ($order->order_address_type == 0)
        {
            $shippingAddress = $this->tempAddressService->getSingleAddress($order->order_address_id);
        } else if($order->order_address_type == 1){
            $shippingAddress = $this->userAddressService->getSingleAddress($order->order_address_id);
        }

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
        $SystemLang['shippingAddress'] = $shippingAddress[0];
        echo view('Admin/header.php');
        echo view('Admin/modules/adminOrderManagerModule.php', $SystemLang);
    }

    public function users()
    {
        if(!$this->sessionService->checkIssetSession('adminLogged')){
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Admin', 'errorDetails' => 'Brak autoryzacjii', 'errorToPage' => 'home']);
            return redirect()->to(base_url('error'));
        }
        $users = $this->userService->getAllUsers();

        $SystemLang['users'] = $users;
        echo view('Admin/header.php');
        echo view('Admin/modules/adminUsersModule.php', $SystemLang);

    }

    public function usermanager()
    {
        if(!$this->sessionService->checkIssetSession('adminLogged')){
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Admin', 'errorDetails' => 'Brak autoryzacjii', 'errorToPage' => 'home']);
            return redirect()->to(base_url('error'));
        }
        $userId = $this->request->getPost('user-id');
        if ($userId == null)
        {
            return redirect()->to(base_url('admin/users'));
        }

        $user = $this->userService->getSingleUserId($userId);
        if ($user == null){
            return redirect()->to(base_url('admin/users'));
        }

        $userAddress = $this->userAddressService->getUserAddress($userId);

        $SystemLang['userAddress'] = $userAddress;
        $SystemLang['user'] = $user[0];
        echo view('Admin/header.php');
        echo view('Admin/modules/adminUserManagerModule.php', $SystemLang);
    }

    public function products()
    {
        if(!$this->sessionService->checkIssetSession('adminLogged')){
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Admin', 'errorDetails' => 'Brak autoryzacjii', 'errorToPage' => 'home']);
            return redirect()->to(base_url('error'));
        }
        $productsList = $this->productService->getAllProducts();

        $SystemLang['productsList'] = $productsList;
        echo view('Admin/header.php');
        echo view('Admin/modules/adminProductsModule.php', $SystemLang);
    }

    public function productmanager()
    {
        if(!$this->sessionService->checkIssetSession('adminLogged')){
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Admin', 'errorDetails' => 'Brak autoryzacjii', 'errorToPage' => 'home']);
            return redirect()->to(base_url('error'));
        }
        $productId = $this->request->getPost('product-id');
        if ($productId == null){
            return redirect()->to(base_url('admin/products'));
        }

        $product = $this->productService->getSingleProduct($productId);
        if ($product == null){
            return redirect()->to(base_url('admin/products'));
        }

        $categoryList = $this->categoryService->getCategory();
        $subcategoryList = $this->categoryService->getAllSubCategory();
        print_r($product);
        $SystemLang['categoryList'] = $categoryList;
        $SystemLang['subcategoryList'] = $subcategoryList;
        $SystemLang['product'] = $product[0];
        echo view('Admin/header.php');
        echo view('Admin/modules/adminProductManagerModule.php', $SystemLang);
    }

    public function addproduct()
    {
        if(!$this->sessionService->checkIssetSession('adminLogged')){
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Admin', 'errorDetails' => 'Brak autoryzacjii', 'errorToPage' => 'home']);
            return redirect()->to(base_url('error'));
        }
        $SystemLang['categoryList'] = $this->categoryService->getCategory();
        $SystemLang['subcategoryList'] = $this->categoryService->getAllSubCategory();
        echo view('Admin/header.php');
        echo view('Admin/modules/adminAddProductModule.php', $SystemLang);
    }

    public function config()
    {
        if(!$this->sessionService->checkIssetSession('adminLogged')){
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Admin', 'errorDetails' => 'Brak autoryzacjii', 'errorToPage' => 'home']);
            return redirect()->to(base_url('error'));
        }

        $SystemLang['subcategory'] = $this->categoryService->getAllSubCategory();
        $SystemLang['statute'] = $this->configService->getStatute();
        $SystemLang['category'] = $this->categoryService->getCategory();

        echo view('Admin/header.php');
        echo view('Admin/modules/adminConfigModule.php', $SystemLang);
    }
}
