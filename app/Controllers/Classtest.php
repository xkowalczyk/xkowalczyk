<?php

namespace App\Controllers;

use App\Models\UserAddressModel;
use App\Libraries\Services\UserService;
use App\Libraries\Services\AuthService;
use App\Libraries\Services\SessionService;
use CodeIgniter\Controller;
use CodeIgniter\Database\Config;

class Classtest extends Controller
{
    private $testSystem;

    public function __construct()
    {
        $this->testSystem = new UserService();
        $this->testSystems = new AuthService();
        $this->testSystemss = new SessionService();
    }

    public function index()
    {
        echo view('templates/header.php');
    }

    public function test()
    {
        $this->testSystemss->setSession('adminLogged', 'ss');
    }
}
