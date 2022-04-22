<?php

namespace App\Controllers;

use App\Libraries\Address;
use App\Libraries\Services\BinService;
use App\Libraries\Services\ProductService;
use App\Libraries\Services\SessionService;
use App\Libraries\Services\SuppliersService;
use App\Libraries\Services\UserAddressService;
use App\Libraries\Services\UserService;
use CodeIgniter\Controller;

class NewOrder extends Controller
{
    private $binService;
    private $productService;
    private $sessionService;
    private $userService;
    private $userAddressService;
    private $suppliersService;

    public function __construct()
    {
        $this->binService = new BinService();
        $this->productService = new ProductService();
        $this->sessionService = new SessionService();
        $this->userService = new UserService();
        $this->userAddressService = new UserAddressService();
        $this->suppliersService = new SuppliersService();
    }

    public function index()
    {
        $this->sessionService->setSession('neworder-token', 'token');
        
        if(!$this->sessionService->checkIssetSession('neworder-token')){
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Zamówienie', 'errorDetails' => 'Próbujesz złożyc nie autoryzowane zamówienie (brak sesji zamówienia)', 'errorToPage' => 'bin']);
            return redirect()->to(base_url('error'));
        }
        if ($this->request->getPost('order-token') == null) {
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Zamówienie', 'errorDetails' => 'Próbujesz złożyc nie autoryzowane zamówienie', 'errorToPage' => 'bin']);
            return redirect()->to(base_url('error'));
        } else if (!$this->sessionService->checkIssetSession('userLogged')) {
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Zamówienie', 'errorDetails' => 'Próbujesz złożyc zamówienie bez autoryzacji konta', 'errorToPage' => 'login']);
            return redirect()->to(base_url('error'));
        }

        $userId = $this->userService->getSingleUser($this->sessionService->getSingleSession('userLogged'))[0]->user_id;
        $orderProduct = $this->binService->getBinItems();
        $productCount = array();

        if ($orderProduct == null) {
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Zamówienie', 'errorDetails' => 'Próbujesz złożyc nie autoryzacyjne zamówienie z brakiem produktów', 'errorToPage' => 'home']);
            return redirect()->to(base_url('error'));
        }

        foreach ($orderProduct as $item) {
            array_push($productCount, [$item[0]->item_id => $this->request->getPost($item[0]->item_id)]);
        }

        
        $SystemLang['userId'] = $userId;
        $SystemLang['orderProduct'] = $orderProduct;
        $SystemLang['productCount'] = $productCount;
        $SystemLang['userAddress'] = $this->userAddressService->getUserAddress($userId);
        $SystemLang['suppliersList'] = $this->suppliersService->getSuppliers();

        echo view('Order/orderForm.php', $SystemLang);
        echo view('templates/footer.php');
    }

    public function confirmation()
    {
        if(!$this->sessionService->checkIssetSession('neworder-token')){
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Zamówienie', 'errorDetails' => 'Próbujesz złożyc nie autoryzowane zamówienie (brak sesji zamówienia)', 'errorToPage' => 'bin']);
            return redirect()->to(base_url('error'));
        }
        if ($this->request->getPost('order_token') == null) {
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Zamówienie', 'errorDetails' => 'Próbujesz złożyc nie autoryzowane zamówienie', 'errorToPage' => 'bin']);
            return redirect()->to(base_url('error'));
        } else if (!$this->sessionService->checkIssetSession('userLogged')) {
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Zamówienie', 'errorDetails' => 'Próbujesz złożyc zamówienie bez autoryzacji konta', 'errorToPage' => 'login']);
            return redirect()->to(base_url('error'));
        }

        $userId = $this->userService->getSingleUser($this->sessionService->getSingleSession('userLogged'))[0]->user_id;
        $orderProduct = $this->binService->getBinItems();
        $productCount = array();
        $fullPrice = 0;

        if ($orderProduct == null) {
            $this->sessionService->setFlashData('errorData', ['errorName' => 'Zamówienie', 'errorDetails' => 'Próbujesz złożyc nie autoryzacyjne zamówienie z brakiem produktów', 'errorToPage' => 'home']);
            return redirect()->to(base_url('error'));
        }

        foreach ($orderProduct as $item) {
            array_push($productCount, [$item[0]->item_id => $this->request->getPost($item[0]->item_id)]);
            $fullPrice = $fullPrice + ((int)$item[0]->item_price*$this->request->getPost($item[0]->item_id));
        }

        if ($this->request->getPost('addressType') != 'on') {
            $userAddress = $this->userAddressService->getSingleAddress($this->request->getPost('address-option'));
        } else {
            $userAddress = new Address(
                null,
                $this->request->getPost('address_city'),
                $this->request->getPost('address_homenumber'),
                $this->request->getPost('address_street'),
                $this->request->getPost('address_postcode')
            );
        }

        $SystemLang['fullPrice'] = $fullPrice;
        $SystemLang['user'] = $this->userService->getSingleUser($this->sessionService->getSingleSession('userLogged'))[0];
        $SystemLang['orderProduct'] = $orderProduct;
        $SystemLang['productCount'] = $productCount;
        $SystemLang['supplier'] = $this->suppliersService->getSingleSupplier($this->request->getPost('suppliersType'))[0];
        $SystemLang['userAddress'] = $userAddress[0];
        
        echo view('Order/newOrderConfirm.php', $SystemLang);
        //$this->sessionService->removeSession('neworder-token');
    }
}
