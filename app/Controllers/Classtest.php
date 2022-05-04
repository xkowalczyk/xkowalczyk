<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\UserAddressModel;
use App\Libraries\Services\UserService;
use App\Libraries\Services\UserAddressService;
use App\Libraries\Services\TempAddressService;
use App\Libraries\Services\AuthService;
use App\Libraries\Services\SessionService;
use CodeIgniter\Controller;
use CodeIgniter\Database\Config;
use App\Libraries;
use App\Libraries\Services\SuppliersService;
use App\Libraries\Services\OrderService;
use App\Models\UserModel;

class Classtest extends Controller
{
    private $testSystem;

    public function __construct()
    {
        $this->testSystem = new UserAddressModel();
        $this->testSystems = new AuthService();
        $this->testSystemss = new SessionService();
        $this->user = new UserModel();
        $this->sup = new SuppliersService();
        $this->order = new OrderService();
        $this->tmp = new TempAddressService();
        $this->s = new Libraries\Services\ConfigService();
    }
    public function index()
    {


        //echo "sss";
        //print_r($this->sup->getSuppliers());
        //$_SESSION['adminLogged'] = "ytmrhc@gmail.com";
        //echo $this->testSystem->getSingleAddress(11);
        //if ($this->testSystemss->checkIssetSession('adminLogged') == true) {
          //  return redirect()->to(base_url('addmin'));
        //}
        //$SystemLang['totalPrice'] = '2137';
        //$SystemLang['userEmail'] = 'ytmrhc@gmail.com';
        echo view('test.php');

    }

    public function test()
    {
        //$_COOKIE['bin'] = '1,2,';
        $data = array(
          'user_address_user' => 'ytmrhc@gmail.com',
          'user_address_user_id' => '2',
          'user_address_street' => 'ulica',
          'user_address_city' => 'miasto',
          'user_address_homenumber' => 'numer domu',
          'user_address_postcode' => 'kod pocztowy',
        );

        print_r($this->s->getStatute());
        //echo $this->tmp->getNewAddressId(2);
        //echo $this->order->getNewOrderId();
    }
}
