<?php

namespace App\Controllers;

use App\Models\UserAddressModel;
use App\Libraries\Services\UserService;
use App\Libraries\Services\UserAddressService;
use App\Libraries\Services\AuthService;
use App\Libraries\Services\SessionService;
use CodeIgniter\Controller;
use CodeIgniter\Database\Config;
use App\Libraries;
use App\Libraries\Order;
use App\Libraries\Services\SuppliersService;
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
    }

    public function index()
    {

        //print_r($this->sup->getSuppliers());  
        $_SESSION['userLogged'] = "tomek.balboa@onet.pl";   
        //echo $this->testSystem->getSingleAddress(11);
        //if ($this->testSystemss->checkIssetSession('adminLogged') == true) {
          //  return redirect()->to(base_url('addmin'));
        //}
        $SystemLang['totalPrice'] = '2137';
        $SystemLang['userEmail'] = 'ytmrhc@gmail.com';
        echo view('test.php', $SystemLang);
    }

    public function test()
    {
    }
}
